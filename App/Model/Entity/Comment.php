<?php

namespace App\Model\Entity;

class Comment extends Base{
  protected $_id;
  protected $_rev;
	protected $name;
	protected $email;
	protected $content;
	protected $url;
	protected $ip;
  protected $article_id;
  protected $type='comment';
  protected $approved='true';
  protected $published='true';
  protected $created_at;
  protected $updated_at;
}