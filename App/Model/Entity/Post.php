<?php
namespace App\Model\Entity{
  class Post extends Base{
    protected $ID;
    protected $post_author;
    protected $post_date;
    protected $post_date_gmt;
    protected $post_content;
    protected $post_title;
    protected $post_excerpt;
    protected $post_status;
    protected $comment_status;
    protected $ping_status;
    protected $post_password;
    protected $post_name;
    protected $to_ping;
    protected $pinged;
    protected $guid;
  }
}