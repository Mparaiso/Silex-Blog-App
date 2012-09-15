<?php
namespace App\Model\Manager{

  use App\Model\Entity\User as UserEntity ;

  interface IUserManager{

    function isLoggedIn();

    function usernameExists($username);

    function emailExists($email);

    function getByUsername($username);

    /**
     * 
     * @param string $user_id
     * @return UserEntity
     */
    function getById($user_id);
    
    function getByEmail($email);

    function registerUser(UserEntity $user);

    function getUser();

    function remove($user_id);

  }

}