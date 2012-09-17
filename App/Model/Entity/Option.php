<?php
/**
 * related to wordpress options
 */
namespace App\Model\Entity{
  class Option extends Base{
    protected $option_id;
    protected $blog_id="silexblog";
    protected $option_name;
    protected $option_value;
    protected $autoload="yes";
  }
}