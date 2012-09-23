<?php
namespace App\Model\Manager{

  use Silex\Application;
  use Symfony\Component\Security\Core\User\UserProviderInterface;
  use Symfony\Component\Security\Core\User\UserInterface;
  use Symfony\Component\Security\Core\User\User;
  use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
  use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
  use App\Model\Entity\User as UserEntity ;
  use MongoId;
  use MongoDate;
  use Symfony\Component\Security\Core\SecurityContext;
  use Symfony\Component\Security\Core\SecurityContextInterface;
  use Exception;

  class UserManager extends BaseManager implements UserProviderInterface,IUserManager{

    protected $collection = 'user';
    protected $_collection;
    // protected $securityContent;
    protected $_app;

    function __construct(\Mongo $connection,$database,Application $app) {
      parent::__construct($connection, $database);
      $this->_collection = $this->getCollection();
      // $this->_securityContext = $securityContent;
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

    function getByUsername($username) {
      $user = $this->_collection->findone(array('username' => $username));
      return new UserEntity($user);
    }

    /**
     * 
     * @param string $user_id
     * @return UserEntity
     */
    function getById($user_id){
      return $this->getCollection()->findone(array("_id"=>new MongoId($user_id)));
    }
    
    function getByEmail($email){
      $user = $this->_collection->findone(array('email'=>$email));
      return new UserEntity($user);
    }

    function registerUser(UserEntity $user) {
      if($this->usernameExists($user['username'])):
        throw new Exception("The username is already taken");
      elseif($this->emailExists($user['email'])):
        throw new Exception("The email is already taken");
      endif;
      $user['created_at']=new MongoDate();
      $user['updated_at']=new MongoDate();
      $userToCommit = $user->toArray();
      unset($userToCommit['_id']);
      $status = $this->_collection->insert($userToCommit, array('safe' => true));
      return new UserEntity($userToCommit);
    }

    function getUser() {
      $token = $this->_app['security']->getToken();
      if (null != $token):
        $user = $token->getUser();
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
        $user = new UserEntity($_user);
      endif;
      return new User($user['username'], $user['password'], $user['roles'], $user['enabled'], $user['userNonExpired'], $user['credentialsNonExpired'], $user['userNonLocked']);
    }

    function refreshUser(UserInterface $user) {
      if (!$user instanceof User) {
        throw new UnsupportedUserException(sprintf('Instance of "%s" are not supported'), get_class($user));
      }
      return $this->loadUserByUsername($user->getUsername());
    }

    function supportsClass($class) {
      return $class === 'Symfony\Component\Security\Core\User\User';
    }
  
  }

}