<?php
/**
 * @copyright 2010 P.PARAISO
 * inspired by https://github.com/achingbrain/php5-akismet
 */
namespace Net\Mpmedia\Akismet{

  use Net\Mpmedia\Http\HttpClient;

  class Akismet{

    const AKISMET_SERVER = "rest.akismet.com";

    protected $siteUrl;
    protected $apiKey;
    protected $header = "Content-type: application/x-www-form-urlencoded";
    protected $method="POST";
    public $commentAuthor;
    public $commentAuthorEmail;
    public $commentAuthorURL;
    public $commentContent;
    protected $commentUserAgent;
    protected $commentUserReferrer;
    protected $commentUserIp;
    protected $permalink;
    public $responseBody;
    public $responseHeader;
    /**
     * @var HttpClient
     */
    protected $httpClient;

    function __construct($siteUrl,$apiKey,$httpClient=null){
      $this->httpClient = $httpClient===null?new HttpClient():$httpClient;
      $this->siteUrl=$siteUrl;
      $this->apiKey=$apiKey;
      $this->apiPort=80;
      if(isset($_SERVER['HTTP_USER_AGENT'])) {
        $this->commentUserAgent = $_SERVER['HTTP_USER_AGENT'];
      } 
      if(isset($_SERVER['HTTP_REFERER'])) {
        $this->commentReferrer = $_SERVER['HTTP_REFERER'];
      }
      /*
       * This is necessary if the server PHP5 is running on has been set up to run PHP4 and
       * PHP5 concurently and is actually running through a separate proxy al a these instructions:
       * http://www.schlitt.info/applications/blog/archives/83_How_to_run_PHP4_and_PHP_5_parallel.html
       * and http://wiki.coggeshall.org/37.html
       * Otherwise the user_ip appears as the IP address of the PHP4 server passing the requests to the
       * PHP5 one...
       */
      if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != getenv('SERVER_ADDR')) {
        $this->commentUserIp = $_SERVER['REMOTE_ADDR'];
      } else {
        $this->commentUserIp = getenv('HTTP_X_FORWARDED_FOR');
      }
    }

    protected function buildQuery(){
      return http_build_query(
        array(
          "blog"=>$this->siteUrl,
          "user_ip"=>$this->commentUserIp,
          "user_agent"=>$this->commentUserAgent,
          "referrer"=>$this->commentReferrer,
          "permalink"=>$this->permalink,
          "comment_type"=>$this->commmentType,
          "comment_author"=>$this->commentAuthor,
          "comment_author_email"=>$this->commentAuthorEmail,
          "comment_author_url"=>$this->commentAuthorUrl,
          "comment_content"=>$this->commentContent,
          )
        );
    }

    function keyIsValid(){

    }

    /**
     * Tell if a submitted comment is spammy 
     * @return bool
     */
    function isSpam(){
      $this->httpClient->configure(
        array(
          "url"=>"http://".$this->apiKey.".".self::AKISMET_SERVER."/1.1/comment-check",
          "header"=>$this->header,
          "method"=>$this->method,
          "content"=>$this->buildQuery()
          )
        );
      $response= $this->httpClient->send()=="true";
      $this->responseHeader = $this->httpClient->responseHeader;
      $this->responseBody = $this->httpClient->responseBody;
      return $response;
    }

    /** 
     * submit new spam data 
     * @return string
     */
    function submitSpam(){
      $this->httpClient->url="http://".$this->apiKey.'.'.self::AKISMET_SERVER.'/1.1/submit-spam';
      $this->httpClient->header = $this->header;
      $this->httpClient->method = $this->method;
      $this->httpClient->content = $this->buildQuery;
      return $this->httpClient->send();
    }

    /**
     * tell AKISMET that this person is not a spam 
     * @return string
     */
    function submitHam(){
      $this->httpClient->url="http://".$this->apiKey.'.'.self::AKISMET_SERVER.'/1.1/submit-ham';
      $this->httpClient->header = $this->header;
      $this->httpClient->method = $this->method;
      $this->httpClient->content = $this->buildQuery;
      return $this->httpClient->send();
    }
    

    #@note @php FR : créer un getter magique
    function __get($attr){
      $method = "get".ucwords($attr);
      #@note @php FR : reflexion sur les propriétés
      if(method_exists($this, $method)):
        $this->$method();
      elseif(property_exists($this,$attr)):
        return $this->$attr;
      endif;
    }

    #@note @php FR : créer un setter magique
    function __set($attr,$value){
      $method="set".ucwords($attr);
      if(method_exists($this, $method)):
        $this->$method($value);
      elseif(property_exists($this,$attr)):
        $this->$attr = $value;
      endif;
    }

  }
}