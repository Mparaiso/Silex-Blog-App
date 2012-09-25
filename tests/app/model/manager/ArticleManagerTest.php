<?php

namespace App\Model\Manager{

  use App\Model\Manager\ArticleManager;
  use App\Model\Manager\UserManager;
  use Silex\Application;
  use \MongoId;
  use \Mongo;
  use App\Model\Entity\Article;

  /** unit test of  ArticleManager* */
  class ArticleManagerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var ArticleManager
     */
    protected $articleManager;
    protected $userManager;
    protected $user;
    protected $article;

    /**
     * @note @phpunit mettre en route un test
     */
    function setUp() {
      #init
      $this->articleManager = new ArticleManager(new Mongo("localhost"), "test");
      $this->userManager = new UserManager(new Mongo("localhost"), "test", getApp());
      $this->user = new \App\Model\Entity\User(array(
        "username" => "fake_usr".rand(0,1000),
        "type" => 'user',
        "email"=>"fake_email".rand(0,1000),
        "roles" => array("ROLE_ADMIN"),
        ));
      #commit user
      $this->user = $this->userManager->registerUser($this->user);
      $this->article = new \App\Model\Entity\Article(array(
        'type' => 'article',
        'title' => 'fake_article',
        'content' => 'content of the fake article',
        'user_id' => new \MongoId($this->user["_id"]),
        ));
      #commit article with user_id
      $this->article = $this->articleManager->insert($this->article, $this->user['_id']);
    }

    function testGetByUserId() {
      //print("\n user_id = {$this->user['_id']} \n");
      $articles = $this->articleManager->getByUserId($this->user['_id']);
      $this->assertTrue(!empty($articles));
      $this->assertTrue(count($articles)>0);
    }

    function testBelongsTo() {
      //print "\n article.user_id : " . $this->article['user_id'] . "\n";
      //print ' user id : ' . $this->user['_id'];
      $assertions = $this->articleManager->belongsTo($this->article['_id'], $this->user['_id']);
      # should be true
      $this->assertTrue($assertions);
    }

    function testCreate() {
      $article =new Article(array('title' => 'title of the article', 'content' => 'content of the article'));
      $this->assertTrue($article['_id'] == null);
      $article = $this->articleManager->insert($article, $this->user['_id']);
      $this->assertTrue($article['_id'] != null);
    }

    /**
     *@note @phpunit nettoyer après un test
     */
    function tearDown() {
      $this->articleManager = new ArticleManager(new Mongo("localhost"), "test");
      $this->userManager = new UserManager(new Mongo("localhost"), "test", getApp());
      $this->userManager->remove(new MongoId($this->user['_id']));
      $this->articleManager->remove(new MongoId($this->article['_id']));
    }
  }
}