<?php
namespace App\Model\Manager{
  
  use App\Model\Entity\Comment;
  use App\Model\Entity\User;

  interface ISpamManager{

    function ipIsSpammer($ip);

  }
}