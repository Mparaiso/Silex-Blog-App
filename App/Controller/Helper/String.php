<?php
namespace App\Controller\Helper;

class String{

  /**
   * This filters a string into a "friendly" string
   * for use in URL's. It converts the string to lower
   * case and replaces any non-alphanumeric
   * (and accented) characters with dashes.
   * 
   */
  function slug($str){
    $str = strtolower(trim($str));
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = preg_replace('/-+/', "-", $str);
    return $str;
  }
}