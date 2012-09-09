<?php

namespace App\Model\Manager{

  use MongoId;
  use App\Model\Entity\Article;

  class ArticleManager extends BaseManager {

    protected $collection = "article";

    /**
     * check if an article belongs to a user
     */
    function belongsTo($article_id, $user_id) {
      $query = array("_id" => new MongoId($article_id), "user_id" => new MongoId($user_id));
      $article = $this->_collection->findOne($query);
      return !empty($article);
    }

    function insert(Article $article, $user_id) {
      $article->type= 'article';
      $article->created_at = new \MongoDate();
      $article->user_id = new \MongoId($user_id);
      $this->_collection->insert($article->toArray(), array('safe' => true));
      return $article;
    }

    /**
     * 
     * @param type $article_id
     * @param array $datas
     * @return array
     */
    function update($article_id,Article $articleToUpdate) {
      $article = $this->getById($article_id);
      $article['type'] = 'article';
      $article['content'] = $articleToUpdate['content'];
      $article['title'] = $articleToUpdate['title'];
      $article['tags'] = $articleToUpdate['tags'];
      $article['updated_at'] = new \MongoDate();
      $this->_collection->save($article,array('safe' => true));
      return new Article($article);
    }

    function remove($article_id) {

      $this->_collection->remove(array('_id' => new MongoId($article_id)));
    }

    function getById($id) {
      $article = $this->_collection->findone(array("_id" => new \MongoId($id)));
      return $article;
    }

    function getBySlug($slug) {
      $article = $this->_collection->findone(array('slug' => $slug));
      return $article;
    }

    function getByUserId($user_id) {

      return $this->getArticles(array("created_at" => -1), array("user_id" => new MongoId($user_id)));
    }

    /**
     * obtenir les articles
     * @param \Silex\Application $app
     * @return mixed
     */
    function getArticles(array $sort = array(), array $match = array(), $asArray = true) {
      $cursor = $this->_collection->find($match);
      $cursor->sort($sort);
      if ($asArray == true):
        #@note @silex transformer un iterator en un array
        $articles = iterator_to_array($cursor);
        return $articles;
      else:
        return $cursor;
      endif;
    }

    # HELPERS

    function getArticlesFromIds(array $ids) {
      foreach ($ids as $value) {
        $article = $this->_collection->findOne(array('_id' => new MongoId($value)));
        if(!empty($article)) $articles[]=$article;
      }
      #$r = iterator_to_array( $this->_collection->find(array('_id'=>array('$in'=>$ids))));
      return $articles;
    }

    /**
      *@return array
      */
    function getFirstThreeArticles(){
      $cursor = $this->getArticles(array("created_at"=>-1),array(),false);
      $articles = $cursor->limit(3);
      return iterator_to_array($cursor->limit(3));
    }

  }

}