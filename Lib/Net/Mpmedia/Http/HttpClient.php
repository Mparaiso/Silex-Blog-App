<?php
namespace Net\Mpmedia\Http{

  use Exception;

  class HttpClient implements IHttpClient{

    protected $useHttps=false;

    protected $port=80;

    protected $url;

    protected $method="GET";
    protected $max_redirects=20;
    protected $ignore_errors=false;
    protected $header;
    protected $user_agent;
    protected $content;
    protected $proxy;
    protected $request_fulluri=false;
    protected $protocol_version;
    protected $follow_location=1;

    protected $responseHeader;
    protected $responseBody;


    protected $streamContext;


    function __get($attr){
      $method = "get".ucwords($attr);
      if(method_exists($this, $method)):
        $this->$method();
      elseif(property_exists($this,$attr)):
        return $this->$attr;
      else:
        throw new Exception("This property $attr doesnt exit", 1);
      endif;
    }

    function __set($attr,$value){
      $method="set".ucwords($attr);
      if(method_exists($this, $method)):
        $this->$method($value);
      elseif(property_exists($this,$attr)):
        $this->$attr = $value;
      return $this->$attr;
      else:
        throw new Exception("This property $attr doesnt exit", 1);

      endif;
    }

    /**
     * @see http://php.net/manual/en/context.http.php
     */
    protected function setStreamContext(array $options){
      return $this->streamContext = stream_context_create($options);
    }

    protected function getProtocol(){
      if($this->useHttps):
        return "https";
      else:
        return "http";
      endif;
    }

    function configure(array $options){
      foreach($options as $key=>$value):
        if(property_exists($this, $key)):
          $this->__set($key,$value);
        endif;
      endforeach;
    }

    function send(){
      $protocol = $this->getProtocol();
      $this->streamContext = $this->setStreamContext(
        array(
          "$protocol"=>array(
           "method"=>$this->method,
           "content"=>$this->content,
           "header"=>$this->header,
           "max_redirects"=>$this->max_redirects,
           "user_agent"=>$this->user_agent,
           )
          )
        );
      try {
        $result = file_get_contents($this->url,false,$this->streamContext);
      } catch (Exception $e) {
        throw new HttpClientException($e->getMessage(), 1);
      }
      #@note @php FR : lire les headers généré par un file_get_contents
      # $http_response_header est défini au niveau local par php
      #http://www.php.net/manual/en/reserved.variables.httpresponseheader.php
      $this->responseBody = $result;
      $this->responseHeader =$http_response_header; 
      return $result;
    }
  }
}