<?php

namespace App\Controller\Admin{

  use Silex\Application;
  use Silex\ControllerProviderInterface;
  use Silex\ControllerCollection;
  use Symfony\Component\HttpKernel\HttpKernelInterface;
  use Symfony\Component\Form\Form;

  use App\Model\Entity\Article;
  use App\Form\ArticleForm;

  use App\Model\Manager\ArticleManager;

  class ArticleAdminController implements ControllerProviderInterface {

    /**
    * @var string
    */
    protected $form;

    /**
     * @var ArticleManager
     */
    protected $articleManager;

    function __construct(ArticleManager $articleManager){
      $this->articleManager = $articleManager;
    }

    public function connect(Application $app) {
      // créer un nouveau controller basé sur la route par défaut
      $article = $app['controllers_factory'];

      $article->get("/create", array($this,"create"))->bind("admin.article.create");
      #@note @silex nommer une route named route (doc page 13)
      $article->post("/post", array($this,"post"))->bind("admin.article.post");
      #update
      $article->match("/edit/{id}", array($this,"edit"))->bind("admin.article.edit")->before($app["filter.mustbeowner"]);
      #delete
      $article->get("/delete/{id}", array($this,"delete"))->bind("admin.article.delete")->before($app["filter.mustbeowner"]);
      #dashboard
      $article->get('/dashboard', array($this,"getDashboard"))->bind("admin.article.dashboard");    
      return $article;
    }

    /**
    * Lister les blog posts
    * @param \Silex\Application $app
    * @return mixed
    */
    public function index(Application $app) {
      $articles = $this->articleManager->getArticles(array('created_at' => -1));
      return $app["twig"]->render("article/index.twig", array("articles" => $articles));
    }

    function getBySlug(Application $app, $slug) {
      $article = $this->articleManager->getBySlug($slug);
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
      $this->form = $app['form.factory']->create(new ArticleForm());
      return $app["twig"]->render("article/create.twig", array("form" => $this->form->createView()));
    }

    /**
    * poster un blogpost
    * @param \Silex\Application $app
    */
    public function post(Application $app) {
      $this->form = $app['form.factory']->create(new ArticleForm());
      #@note @silex récupère les données post de la requète
      $this->form->bindRequest($app["request"]);
      #@note @silex valide le formulaire
      if ($this->form->isValid()):
      #@note @silex obtenir les données d'un formulaire.
        $articleDatas = $this->form->getData();
      $article = new Article();
      $user = $app['user_manager']->getUser();
      $article->created_at = new \MongoDate();
      $article->type = "article";
      $article->slug = \App\Controller\Helper\String::slug($articleDatas["title"]) . "-" . md5(date("r"));
      $article->update_count = 0;
      $article->title=$articleDatas['title'];
      $article->content=$articleDatas['content'];
      $article->metadatas = $articleDatas['metadatas'];
      $article->tags= $articleDatas['tags'];
      $article_ = $this->articleManager->insert($article, $user['_id']);
      $app["session"]->setFlash("success", "Article \"$article_[title]\" , $article_[_id] , saved !");
      return $app->redirect($app['url_generator']->generate("admin.article.dashboard"));
      else:
        $app["session"]->setFlash("error", "The form contains errors !");
      endif;
      $request = $app["request"];
      return $app['twig']->render("article/create.twig", array("form" => $this->form->createView()));
    }

    function edit(Application $app, $id) {
      $article = $this->articleManager->getById($id);
      $article->metadatas=$this->transformMetadatas($article->metadatas);
      /** @var $form Form **/
      $form = $app['form.factory']->create(new ArticleForm());
      if("POST"===$app['request']->getMethod()){
        $form->bindRequest($app["request"]);
        if ($form->isValid()){
          $articleDatas = $form->getData();
          $article->content = $articleDatas['content'];
          $article->title = $articleDatas['title'];
          $article->tags = $articleDatas['tags'];
          $article->metadatas = $articleDatas['metadatas'];
          $article->feature = $articleDatas['featured'];
          $this->articleManager->update($id,$article);
          $app["session"]->setFlash("success", "the article was updated");
          return $app->redirect($app["url_generator"]->generate('admin.article.dashboard'));
        }else{
          $app["session"]->setFlash("error", "the form contains errors");
        }
      }else{
        $form->setData($article);
      }
      return $app["twig"]->render("article/edit.twig", array('article_id' => $id, 'article' => $article, 'form' => $form->createView()));
    }

    function delete(Application $app, $id) {
      $this->articleManager->remove($id);
      $app["session"]->setFlash("success", "Article $id deleted! ");
      return $app->redirect($app["url_generator"]->generate('admin.article.dashboard'));
    }

    function getDashboard(Application $app) {

      $current_page = $app['request']->get("current_page") ? (int) $app['request']->get("current_page") : 1;
      $articles_per_pages = $app['request']->get('articles_per_pages') ? (int) $app['request']->get('articles_per_pages') : 5;
      $currentUser = $app['user_manager']->getUser();
      $app['monolog']->addInfo("current user : " . json_encode($currentUser));
      $articles = $this->articleManager->getByUserId($currentUser['_id']);
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
      $articles = $this->articleManager->getArticlesFromIds($ids);
      return $app['twig']->render('article/featured.twig', array('articles' => $articles));
    }

    function transformMetadatas(array $metadatas){
      foreach($metadatas as $key=>$value):
        $result[]=array('name'=>$key,'value'=>$value);
      endforeach;
      return $result;
    }

  }

}