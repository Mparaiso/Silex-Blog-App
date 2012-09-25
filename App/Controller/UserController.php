<?php

namespace App\Controller{

  use Silex\Application;
  use Silex\ControllerProviderInterface;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Form\FormError;
  use Symfony\Component\Security\Core\User\User as  AdvancedUser;
  use App\Model\Entity\User ;
  use App\Model\Manager\ISpamManager;
  use App\Model\Manager\IUserManager;


  /**
   * Gère les utilisateurs de l'application.
   */
  class UserController implements ControllerProviderInterface {

    /**
     * protect from spammer !
     * @var ISpamManager
     */
    protected $spamManager;

    function __construct(IUserManager $userManager,ISpamManager $spamManager){
      $this->userManager = $userManager;
      $this->spamManager = $spamManager;
    }

    function connect(Application $app) {
      $user = $app['controllers_factory'];
        #@note @silex nommer une route
      $user->match('/login', array($this,"login"))->bind('user.login');
      $user->get('/logout', array($this,"logout"))->bind('user.logout');
      $user->get('/signup', array($this,"signup"))->bind('user.signup');
      $user->post('/dosignup', array($this,"doSignUp"))->bind('user.dosignup');
      return $user;
    }

    function login(Application $app, Request $request) {
      $loginForm = $app['form.factory']->create(new \App\Form\Login());
      $form_error = $app['security.last_error']($request);
      $app['monolog']->addInfo($form_error);
      if ($form_error != null):
        $loginForm->addError(new FormError($form_error));
      $app['session']->setFlash("error", "Wrong credentials");
      endif;
      $last_username = $app['session']->get('_security.last_username');
      return $app['twig']->render('user/login.twig', array('loginForm' => $loginForm->createView(), "form_error" => $form_error, 'last_username' => $last_username));
    }

    function signUp(Application $app) {
      $registrationForm = $app['form.factory']->create(new \App\Form\Register());
      return $app['twig']->render('user/register.twig', array("registrationForm" => $registrationForm->createView()));
    }

    function doSignUp(Application $app) {
      $registrationForm = $app['form.factory']->create(new \App\Form\Register());
      $registrationForm->bindRequest($app['request']);
      if ($registrationForm->isValid()){
        $datas = $registrationForm->getData();
        $userManager = $app['user_manager'];
        //username must be unique
        if ($userManager->usernameExists($datas['username']) == true){
          $registrationForm->addError(new FormError('username already exists'));
        }
        //email must be unique
        if ($userManager->emailExists($datas['email']) == true){
          $registrationForm->addError(new FormError('email already exists'));
        }
        if ( $registrationForm->isValid() ){
          $user = new User();
          $user['username'] = $datas['username'];
          $user['firstname'] = $datas['firstname'];
          $user['lastname'] = $datas['lastname'];
          $user['email'] = $datas['email'];
          $user['roles'] = array($app['config.default_user_role']); # must be an array
          $user['password'] = self::encodePassword($user['username'],$datas['password_repeated'],$app);
          $user['ip']=$app['request']->getClientIp();
          if(false==$this->spamManager->ipIsSpammer($user['ip'])){ # protect from spammers
            $userManager->registerUser($user);
            //add flash success
            $app['session']->setFlash('success', 'Your account was successfully created, please login');
            return $app->redirect($app['url_generator']->generate('index.index'));
          }
        }
      
      }
      $app['session']->setFlash('error', 'The form contains errors');
      return $app['twig']->render('user/register.twig', array('registrationForm' => $registrationForm->createView()));
    }

    function logout(Application $app) {
      $app['session']->setFlash('success', "You are logged out!");
      $referer = $app['request']->headers->get('referer');
      return $app->redirect($referer != null ? $referer : $app['url_generator']->generate('index.index'));
    }

    /**
     * Encode a password
     * @return string
     */
    static function encodePassword($username,$nonEncodedPassword,$app){
      $user = new  AdvancedUser($username, $nonEncodedPassword);
      $encoder = $app['security.encoder_factory']->getEncoder($user);
      $encodedPassword = $encoder->encodePassword($nonEncodedPassword, $user->getSalt());
      return $encodedPassword;
    }
  }
}