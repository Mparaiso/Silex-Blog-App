<?php

namespace App\Model\Manager;

use Silex\Application;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use App\Model\Entity\User as EntityUser ;
use MongoId;

class UserManager extends BaseManager implements UserProviderInterface {

  protected $collection = 'user';
  protected $_collection;
  protected $_app;

  function __construct(\Mongo $connection, $database, Application $app) {
    parent::__construct($connection, $database);
    $this->_collection = $this->getCollection();
    $this->_app = $app;
  }

  function isLoggedIn() {
    return $this->_app['security']->isGranted('IS_AUTHENTICATED_FULLY');
  }

  function usernameExists($username) {
    $query = array('username' => $username);
    $user = $this->_collection->findOne($query);
    return !empty($user);
  }

  function emailExists($email) {
    $query = array('email' => $email);
    $user = $this->_collection->findOne($query);
    return !empty($user);
  }

  function authenticate($username, $password) {
    $query = array(
        'username' => $username,
        "password" => md5($password . $this->salt)
    );
    $this->_user = $this->_collection->findOne($query);
    if (empty($this->_user)):
      return false;
    endif;
    $this->_app['session']->set('user_id', (string) $this->_user['_id']);
    $this->_app['session']->set('username', (string) $this->_user['username']);
    return true;
  }

  function logout() {
    return $this->_app['session']->remove('user_id');
  }

  protected function _loadData() {
    $id = new \MongoId($this->_app['session']->get('user_id'));
    if (empty($this->_user)):
      $this->_user = $this->_collection->findOne(array('_id' => $id));
    endif;
    return $this->_user;
  }

  function getByUsername($username) {
    $user = $this->_collection->findone(array('username' => $username));
    return $user;
  }

  function registerUser($datas) {
    if($this->usernameExists($datas['username'])):
      throw new Exception("The username is already taken");
    elseif($this->emailExists($datas['email'])):
      throw new Exception("The email is already taken");
    endif;
    $user = new User($datas['username'], $datas['password'], array($this->_app['config.default_user_role']), true, true, true, true);
    $encoder = $this->_app['security.encoder_factory']->getEncoder($user);
    $datas['password'] = $encoder->encodePassword($datas['password'], $user->getSalt());
    $datas['confirmed'] = true;
    $datas['active'] = true;
    $datas['type'] = 'user';
    $datas['roles'] = array($this->_app['config.default_user_role']); # must be an array
    $user = new EntityUser($datas);
    $user['created_at']=new \MongoDate();
    $user['updated_at']=new \MongoDate();
    $userToCommit = $user->toArray();
    unset($userToCommit['_id']);
    $status = $this->_collection->insert($userToCommit, array('safe' => true));
    return $user;
  }

  function getUser() {
    $token = $this->_app['security']->getToken();
    if (null != $token):
      $user = $token->getUser();
      $this->_app['monolog']->addInfo(json_encode($user));
      return $this->getByUsername($user->getUsername());
    endif;
  }

  function remove($user_id) {
    $this->_collection->remove(array('_id' => new MongoId($user_id)));
  }

  /** UserProviderInterface * */

  function loadUserByUsername($username) {
    $_user = $this->_collection->findone(array("username" => $username));
    if (empty($_user)):
      throw new UsernameNotFoundException(sprintf("User %s does not exist", $username));
    else:
      $user = new EntityUser($_user);
    endif;
    return new User($user['username'], $user['password'], $user['roles'], $user['enabled'], $user['userNonExpired'], $user['credentialsNonExpired'], $user['userNonLocked']);
  }

  function refreshUser(UserInterface $user) {
    #$this->_app['monolog']->addInfo("refreshing user".json_encode($user));
    if (!$user instanceof User) {
      throw new UnsupportedUserException(sprintf('Instance of "%s" are not supported'), get_class($user));
    }
    return $this->loadUserByUsername($user->getUsername());
  }

  function supportsClass($class) {
    return $class === 'Symfony\Component\Security\Core\User\User';
  }

}