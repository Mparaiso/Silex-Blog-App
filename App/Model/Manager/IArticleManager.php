<?php

namespace App\Model\Manager{

  use MongoId;
  use App\Model\Entity\Article;

  /**
   * EN: Manage access to the article persistance layer,
   * encapsulate all database access
   * FR : Gère l'acces à la couche de donnée des articles , 
   * encapsule tout les accès à la base de donnée
   */
  interface IArticleManager{

    /**
     * check if an article belongs to a user
     * @param integer $article_id the id of the article
     * @param integer $user_id the id of the user
     * @return boolean
     */
    function belongsTo($article_id, $user_id);

    /**
     * @return Article
     */
    function insert(Article $article, $user_id);

    /**
     * 
     * @param type $article_id
     * @param array $datas
     * @return Article
     */
    function update($article_id,Article $article);

    function remove($article_id);

    /**
     * @return Article
     */
    function getById($id);

    function getBySlug($slug);

    function getByTag($tag);

    function getByUserId($user_id);

    /**
     * obtenir les articles
     * @param \Silex\Application $app
     * @return mixed return a cursor or an array
     */
    function getArticles(array $sort = array(), array $match = array(), $asArray = true);
  }

}