<?php

namespace Net\Mpmedia\Gravatar{

  class Gravatar{
    /**
     *
     * @var string
     */
    const URL = "http://www.gravatar.com/avatar/";
    /**
     * returns a gravatar url
     * @param string $email
     * @param string $size
     * @return string
     */
    function getGravatar($email,$size=50){
      return self::URL."?gravatar_id=".md5(strtolower($email))."&size=$size";
    }
  }

}