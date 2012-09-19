<?php

namespace App\Controller{

  use Silex\Application;
  use Silex\ControllerProviderInterface;
  use Silex\ControllerCollection;
  use Symfony\Component\HttpKernel\HttpKernelInterface;
  use Symfony\Component\Form\Form;

  use App\Model\Manager\IArticleManager;
  use App\Model\Manager\IUserManager;

  class ArticleController implements ControllerProviderInterface {

    /**
     * @var IArticleManager
     */
    protected $articleManager;
    protected $userManager;

    function __construct(IArticleManager $articleManager,IUserManager $userManager){
      $this->articleManager = $articleManager;
      $this->userManager = $userManager;
    }

    public function connect(Application $app) {
      // créer un nouveau controller basé sur la route par défaut
      $articleController = $app['controllers_factory'];
      $articleController->get('/feature', array($this,"getFeaturedArticles") )->bind("article.featured");
      $articleController->match("/", array($this,"index"))->bind("article.index");
      $articleController->get("/slug/{slug}", array($this,"getBySlug") )->bind("article.get");
      $articleController->get("/tag/{tag}", array($this,"getByTag") )->bind("article.getbytag")->convert( 'tag',function($tag){return urldecode($tag);} );
      //get by username
      $articleController->match('/user/{username}',array($this,"getByUsername"))->bind("article.getbyusername");
      return $articleController;
    }

    /**
     * Lister les blog posts
     * @param \Silex\Application $app
     * @return mixed
     */
    function index(Application $app) {
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

    function getByTag(Application $app,$tag){
      $articles = $this->articleManager->getByTag($tag);
      return $app['twig']->render("article/getbytag.twig",array("tag"=>$tag,'articles'=>$articles));
    }

    function paginator($items, $current_page = null, $item_per_page = 5) {
      if ($current_page !== null):
        $items = array_slice($items, ((int) $current_page - 1) * (int) $item_per_page, $item_per_page);
      endif;
      return $items;
    }

    function getFeaturedArticles(Application $app) {
      $articles = $this->articleManager->getFirstThreeArticles();
      return $app['twig']->render('article/featured.twig', array('articles' => $articles) );
    }

    /**
     * get all articles from user
     * @param Application app a silex application
     * @param string username the name of the user
     * @return string
     */
    public function getByUsername(Application $app,$username){
      $user = $this->userManager->getByUsername($username);// get user
      $userId = $user['_id'];// get user id
      $articles = $this->articleManager->getByUserId($userId);// get articles by user id
      return $app['twig']->render('article/getbyusername.twig',array('articles'=>$articles,'username'=>$user['username']));
    }
    
  }
}