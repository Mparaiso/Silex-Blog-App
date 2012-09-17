<?php
namespace App\Model\Manager{
  
  use App\Model\Entity\Comment;
  use App\Model\Entity\User;

  interface ISpamManager{

    function commentIsSPam(Comment $comment);
    function userIsSpammer(User $user);

  }
}