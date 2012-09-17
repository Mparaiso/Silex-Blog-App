<?php
namespace App\Model\Manager{

  use App\Model\Entity\Comment;
  use App\Model\Entity\User;
  use Net\Mpmedia\Akismet\Akismet;

  class SpamManager extends BaseManager implements ISpamManager{
    protected $collection = "spam";

    protected $akismetHost;
    protected $akismetKey;

    protected $akismet;

    function __construct(\Mongo $connexion,$database,$host=null,$apikey=null){
      parent::__construct($connexion,$database);
      $this->akismetHost = $host;
      $this->akismetKey = $apikey;
    }

    function createAkismet(){
      return new Akismet($this->akismetHost,$this->akismetKey);
    }

    /**
     * @return bool
     */ 
    function commentIsSpam(Comment $comment)
    {
      $this->akismet = $this->createAkismet();
      $this->akismet->commentAuthor = $comment['name'];
      $this->akismet->commentAuthorEmail=$comment['email'];
      $this->akismet->commentAuthorURL=$comment['url'];
      $this->akismet->commentContent = $comment['content'];
      return $this->akismet->isSpam();
    }

    /**
     * @return bool
     */ 
    function userIsSpammer(User $user){
      $this->akismet = $this->createAkismet();
      $this->akismet->commentAuthor = $user['username'];
      $this->akismet->commentAuthorEmail=$user['email'];
      return $this->akismet->isSpam();
    }
  }
}