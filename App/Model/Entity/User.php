<?php

namespace App\Model\Entity;

class User extends Base{

	protected $_id;
	protected $username;
	protected $firstname;
	protected $lastname;
	protected $password;
	protected $address;
	protected $email;
  protected $roles = array('ROLE_WRITER');
  protected $enabled;
	protected $userNonExpired=true;
	protected $credentialsNonExpired=true;
  protected $userNonLocked=true;

}