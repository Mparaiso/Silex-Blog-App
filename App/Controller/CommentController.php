<?php

namespace App\Controller{

  use Silex\Application;
  use Silex\ControllerProviderInterface;
  use Silex\ControllerCollection;
  use Symfony\Component\HttpKernel\HttpKernelInterface;
  use Symfony\Component\Form\Form;

  use App\Model\Manager\ISpamManager;

  use Net\Mpmedia\Akismet\Akismet;

  class CommentController implements ControllerProviderInterface {
    /**
     * @var ISpamManager
     */
    protected $spamManager;

    function __construct(ISpamManager $spamManager){
      $this->spamManager = $spamManager;
    }

    public function connect(Application $app) {
      $comment = $app["controllers_factory"];
      //routes
      $comment->match("/create/{article_id}", array($this,"create"))->bind("comment.create");
      $comment->match("/{article_id}", array($this,"index"))->bind("comment.index");
      //$this->spamManager = $app['spam_manager'];
      return $comment;
    }

    public function index(Application $app,$article_id){
      $commentManager = $app['comment_manager'];
      $comments = $commentManager->getCommentsByArticleId($article_id);
      return $app["twig"]->render("comment/index.twig",array("comments"=>$comments));
    }

    public function create(Application $app, $article_id) {
      $data = array("article_id" => $article_id);
      $commentForm = $app["form.factory"]->create(new \App\Form\Comment(), $data);
      if("POST"===$app['request']->getMethod()){
        $commentForm->bindRequest($app["request"]);
        if($commentForm->isValid()){
          $commentManager = $app['comment_manager'];
          $commentDatas = $commentForm->getData();
          /** @var $comment App\Model\Entity\Comment **/
          $comment = new \App\Model\Entity\Comment($commentDatas);
          $comment->ip  = $app['request']->getClientIp();
          if(false==$this->spamManager->ipIsSpammer($comment->ip)){
            // if comment is not a spam
            $status = $commentManager->insertComment($comment, $article_id);
            $app["session"]->setFlash("success", "new comment added");
          }
        }else{
          $app["session"]->setFlash("error", "Error in the comment");
          $app['session']->setFlash('comment_errors',array_map(function($formError){
            return $formError->getMessageTemplate();
          }, $commentForm->getErrors())
          );
        }
        return $app->redirect($app['request']->headers->get('referer'));
      }
      return $app["twig"]->render("comment/create.twig", array('article_id'=>$article_id,"form" => $commentForm->createView()));
    }


  }

}