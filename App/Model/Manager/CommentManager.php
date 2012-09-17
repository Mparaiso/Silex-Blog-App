<?php

namespace App\Model\Manager{


  use MongoId;
  use MongoDate;

  class CommentManager extends BaseManager {

    protected $collection = "comment";

    function getCommentsByArticleId($id, $sort = array(), $return_as_array = true) {
      $collection = $this->getCollection();
      $cursor = $collection->find(array('article_id' => new MongoId($id)));
      $cursor->sort($sort);
      if ($return_as_array == true):
        return iterator_to_array($cursor);
      else:
        return $cursor;
      endif;
    }

    function insertComment($comment, $article_id) {
      $collection = $this->getCollection();
      $comment["type"] = "comment";
      $comment["article_id"] = new MongoId($article_id);
      $comment["created_at"] = new MongoDate();
      $comment["published"] = true;
      $comment["approved"] = true;
      $status = $collection->insert($comment->toArray(), array("safe" => true));
      return $status;
    }

    function deleteComment($comment_id) {

    }

    function updateComment($comment, $comment_id) {

    }

    function approveComment($comment_id) {

    }

    function blockComment($comment_id) {

    }

  }

}