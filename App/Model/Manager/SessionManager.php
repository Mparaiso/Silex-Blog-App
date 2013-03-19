<?php

namespace App\Model\Manager;

/**
* @see http://php.net/manual/en/class.sessionhandlerinterface.php
*/
class SessionManager extends BaseManager implements \SessionHandlerInterface{

  protected $collection = 'session';

//Expire session after 30 mins in inactivity

  const SESSION_TIMEOUT = 1800;
//Expire session after 2 hour
  const SESSION_LIFESPAN = 7200;
//name of the session cookie
  const SESSION_NAME = 'mongosessid';
  const SESSION_COOKIE_PATH = '/';
//Should be the domain name of you web app, for example
//mywebapp.com. DO NOT use empty string unless you are  
//running on a local environment.
  const SESSION_COOKIE_DOMAIN = '';

  private $_mongo;
  protected $_collection;
  private $_currentSession;

  function __construct(\Mongo $mongo,$database) {
    parent::__construct($mongo,$database);
    $this->_collection = $this->getCollection();
    session_set_save_handler(array(&$this, 'open'), array(&$this, 'close'), array(&$this, 'read'), array(&$this, 'write'), array(&$this, 'destroy'), array(&$this, 'gc'));
# set session garbage collection period
    ini_set('session.gc_maxlifetime', self::SESSION_LIFESPAN);
# session cookie config
    session_set_cookie_params(self::SESSION_LIFESPAN, self::SESSION_COOKIE_PATH, self::SESSION_COOKIE_DOMAIN);
# replace 'phpsessid' with 'mongosessid' as the session name
    session_name(self::SESSION_NAME);
    session_cache_limiter('nocache');
# start session
    //session_start();
  }

  public function open($path, $name) {
    return true;
  }

  public function close() {
    return true;
  }

  public function read($sessionId) {
    $query = array(
        'session_id' => $sessionId,
        'timedout_at' => array('$gte' => time()),
        'expired_at' => array('$gte' => time() - self::SESSION_LIFESPAN)
    );
    $result = $this->_collection->findOne($query);
    $this->_currentSession = $result;
    if (!isset($result['data'])) {
      return '';
    }
    return $result['data'];
  }

  public function write($sessionId, $data) {
    $expired_at = time() + 1800 ; #self::SESSION_TIMEOUT bug around that @TODO fix it
    $new_obj = array(
        'data' => $data,
        'timedout_at' =>
        time() + self::SESSION_TIMEOUT,
        'expired_at' =>
        (empty($this->_currentSession)) ?
                time() + self::SESSION_LIFESPAN : $this->_currentSession['expired_at']
    );
    $query = array('session_id' => $sessionId);
    $this->_collection->update(
            $query, array('$set' => $new_obj), array('upsert' => True)
    );
    return True;
  }

  public function destroy($sessionId) {
    $this->_collection->remove(array('session_id' =>
        $sessionId));
    return True;
  }

  public function gc($maxlifetime) {
    $query = array('expired_at' => array('$lt' => time()));
    $this->_collection->remove($query);
    return True;
  }

  public function __destruct() {
    session_write_close();
  }

}

