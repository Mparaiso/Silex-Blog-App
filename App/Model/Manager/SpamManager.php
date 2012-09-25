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

    protected function _getAkismet(){
      return new Akismet($this->akismetHost,$this->akismetKey);
    }

 

    /**
     * EN : check if a given ip is registered as a spammer
     * FR : vérifier si un ip appartient à un spammer
     * @var $ip string
     * @return bool
     */
    function ipIsSpammer($ip){
      $this->akismet = $this->_getAkismet();
      $this->akismet->commentUserIp = $ip;
      $isSpam = $this->akismet->isSpam();
      if($isSpam==true){
        $this->getCollection()->insert(array("ip"=>$ip));
      }
      return $isSpam;
    }
  }
}