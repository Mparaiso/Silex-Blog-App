<?php
namespace App\Model\Entity{


  class ArticleTest extends \PHPUnit_Framework_TestCase{

    public function setUp(){
    }

    function testSetMetadata(){
      $article = new Article();
      $article->setMeta("color","red");
      $this->assertEquals(1,count($article->metadatas));
      $this->assertEquals("red",$article->metadatas[0]['value']);
      $this->assertEquals("color",$article->metadatas[0]['name']);
    }
  
    function tearDown(){
    }
  }
}