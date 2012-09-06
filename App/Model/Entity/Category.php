<?php

namespace App\Model\Entity{
	class Category extends Base{
		protected $_id;
		protected $_rev;
		protected $name;
		protected $slug;
		protected $description;
		protected $parent_id;
	}
}