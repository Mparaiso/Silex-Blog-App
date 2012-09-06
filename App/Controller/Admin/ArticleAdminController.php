<?php

namespace App\Controller\Admin;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Form\Form;

class ArticleAdminController implements ControllerProviderInterface {

  /**
   * @var string
   */
  protected $form;

  public function connect(Application $app) {
    // créer un nouveau controller basé sur la route par défaut
    $article = $app['controllers_factory'];

    $article->get("/create", 'App\Controller\Admin\ArticleAdminController::create')->bind("admin.article.create");
    #@note @silex nommer une route named route (doc page 13)
    $article->post("/post", 'App\Controller\Admin\ArticleAdminController::post')->bind("admin.article.post");
    #update
    $article->get("/edit/{id}", 'App\Controller\Admin\ArticleAdminController::edit')->bind("admin.article.edit")->before($app["filter.mustbeowner"]);
    $article->post("/put/{id}", 'App\Controller\Admin\ArticleAdminController::put')->bind('admin.article.put')->before($app["filter.mustbeowner"]);
    #delete
    $article->get("/delete/{id}", 'App\Controller\Admin\ArticleAdminController::delete')->bind("admin.article.delete")->before($app["filter.mustbeowner"]);
    #dashboard
    $article->get('/dashboard', 'App\Controller\Admin\ArticleAdminController::getDashboard')->bind("admin.article.dashboard");
    return $article;
  }

  /**
   * Lister les blog posts
   * @param \Silex\Application $app
   * @return mixed
   */
  public function index(Application $app) {
    $articles = $app['article_manager']->getArticles(array('created_at' => -1));
    return $app["twig"]->render("article/index.twig", array("articles" => $articles));
  }

  function getBySlug(Application $app, $slug) {
    $article = $app['article_manager']->getBySlug($slug);
    if ($article == null):
      return $app->redirect($app["url_generator"]->generate("article.index"));
    endif;
    return $app["twig"]->render("article/get.twig", array("article" => $article));
  }

  /**
   * afficher le formulaire de création de blogpost
   * @param \Silex\Application $app
   * @return mixed
   */
  function create(Application $app) {
    $this->form = $this->createArticleForm($app);
    return $app["twig"]->render("article/create.twig", array("form" => $this->form->createView()));
  }

  /**
   * poster un blogpost
   * @param \Silex\Application $app
   */
  public function post(Application $app) {
    $this->form = $this->createArticleForm($app);
    #@note @silex récupère les données post de la requète
    $this->form->bindRequest($app["request"]);
    #@note @silex valide le formulaire
    if ($this->form->isValid()):
      #@note @silex obtenir les données d'un formulaire.
      $article = $this->form->getData();
      $article['created_at'] = new \MongoDate();
      $article['type'] = "article";
      $article["author"] = "admin";
      $article["slug"] = \App\Controller\Helper\String::slug($article["title"]) . " " . md5(date("r"));
      $article["type"] = "article";
      $article["update_count"] = 0;
      $user = $app['user_manager']->getUser();
      $article_ = $app['article_manager']->insert($article, $user['_id']);
      $app["session"]->setFlash("success", "Article \"$article_[title]\" , $article_[_id] , saved !");
    else:
      $app["session"]->setFlash("error", "The form contains errors !");
    endif;
    $request = $app["request"];
    $subrequest = $request::create($app["url_generator"]->generate("admin.article.dashboard"), "GET");
    return $app->handle($subrequest, HttpKernelInterface::SUB_REQUEST);
  }

  function edit(Application $app, $id) {
    $article = $app['article_manager']->getById($id);
    $form = $this->updateArticleForm($app, $article, $id);
    return $app["twig"]->render("article/edit.twig", array('article_id' => $id, 'article' => $article, 'form' => $form->createView()));
  }

  function put(Application $app, $id) {
    $form = $this->updateArticleForm($app);
    $form->bindRequest($app["request"]);
    if ($form->isValid()):
      $article = $app['article_manager']->getById($id);
      $datas = $form->getData();
      $article["title"] = $datas["title"];
      $article["content"] = $datas["content"];
      $article["updated_at"] = new \MongoDate();
      $article["update_count"]++;
      $article = $app['article_manager']->update($id);
      $app["session"]->setFlash("success", "the article was updated");
      return $app->redirect($app["url_generator"]->generate('article.dashboard'));
    else:
      $app["session"]->setFlash("error", "the form contains errors");
      $request = $app["request"];
      $subrequest = $request::create($app["url_generator"]->generate("article.edit", array("id" => $id)), "GET");
      return $app->handle($subrequest, HttpKernelInterface::SUB_REQUEST);
    endif;
  }

  function delete(Application $app, $id) {
    $db = $this->getDb($app);
    $articles = $db->selectCollection("article");
    $status = $articles->remove(array("_id" => new \MongoId($id)), array("safe" => true));
    $app["session"]->setFlash("success", "Article $id deleted! ");
    return $app->redirect($app["url_generator"]->generate('article.dashboard'));
  }

  /**
   *
   * @param \Silex\Application $app
   * @param type $data
   * @return Form
   */
  public function createArticleForm(Application $app, $data = array()) {
    #@NOTE @SILEX créer un formulaire
    $form = $app["form.factory"]->createBuilder("form", $data)
            ->add("title", "text", array("required" => true, "attr" => array("class" => "span4", "placeholder" => "The title")))
            ->add("content", "textarea", array("required" => true, "attr" => array("placeholder" => "the content", "rows" => 4, "class" => "span4")))
            ->add("tags", "text", array("attr" => array("class" => "span4", "placeholder" => "ms, apple ,samsung, nokia")))
            ->getForm();
    return $form;
  }

  /**
   *
   * @param \Silex\Application $app
   * @param type $data
   * @param type $id
   * @return Form
   */
  public function updateArticleForm(Application $app, $data = array(), $id = null) {
    $form = $this->createArticleForm($app, $data);
    $form->add($app["form.factory"]->createBuilder("form", array("id" => $id))
                    ->add("id", "hidden", array("required" => true))
                    ->getForm());
    return $form;
  }

  function getDb(Application $app) {
    $connection = $app["mongo"];
    $db = $connection->selectDB($app["config"]::DATABASE);
    return $db;
  }

  function getDashboard(Application $app) {

    $current_page = $app['request']->get("current_page") ? (int) $app['request']->get("current_page") : 1;
    $articles_per_pages = $app['request']->get('articles_per_pages') ? (int) $app['request']->get('articles_per_pages') : 5;
    $currentUser = $app['user_manager']->getUser();
    $app['monolog']->addInfo("current user : " . json_encode($currentUser));
    $articles = $app['article_manager']->getByUserId($currentUser['_id']);
    $app['monolog']->addInfo("user articles : " . json_encode($articles));
    $total_pages = ceil(count($articles) / $articles_per_pages);
    $paginated_articles = $this->paginator($articles, $current_page, $articles_per_pages);
    return $app["twig"]->render("article/dashboard.twig", array("articles" => $paginated_articles, "current_page" => $current_page, "articles_per_pages" => $articles_per_pages, "total_pages" => $total_pages, 'title' => 'Article Dashboard'));
  }

  function paginator($items, $current_page = null, $item_per_page = 5) {
    if ($current_page !== null):
      $items = array_slice($items, ((int) $current_page - 1) * (int) $item_per_page, (int) $item_per_page);
    endif;
    return $items;
  }

  function getFeaturedArticles(Application $app, $ids) {
    $ids = json_decode($ids);
    $articles = $app['article_manager']->getArticlesFromIds($ids);
    return $app['twig']->render('article/featured.twig', array('articles' => $articles));
  }

}