<?php
namespace App\Model\Entity{

	use App\Model\Entity\Base;

	class BaseTest extends \PHPUnit_Framework_TestCase{
		public function setUp()
		{
			$this->name = "marc";
			$this->myBase = new MyBase(array('name'=>$this->name));
		}

		function testSet(){

			# check setter function works
			$this->assertEquals($this->name."getted",$this->myBase->name);
			$this->assertEquals($this->name."getted",$this->myBase['name']);
			$this->assertEquals($this->name."getted",$this->myBase->getName());
			$this->myBase->setName('David');
			$this->assertEquals("Davidgetted",$this->myBase->name);
			# check that non existing properties are null;
			$this->myBase->sex = "man";
			$this->assertNull($this->myBase->sex);
			$this->myBase['sex']="man";
			$this->assertNull($this->myBase['sex']);
			return ;
		}
		/**
		*@depends testSet
		*/
		function testGet(){
			$this->name = "Marc";
			$this->myBase = new MyBase(array('name'=>$this->name));
			$this->assertEquals($this->name."getted",$this->myBase['name']);
			$this->assertEquals($this->name."getted",$this->myBase->name);
			$this->assertEquals($this->name."getted",$this->myBase->getName());
			$this->myBase->age = 25;
			$this->assertEquals(25,$this->myBase['age']);
			$this->assertEquals(25,$this->myBase->age);
			$this->assertEquals("human",$this->myBase->race);
			$this->assertEquals("human",$this->myBase['race']);
			$this->assertEquals("human",$this->myBase->getRace());
		}

		function testToArray(){
			$myBaseArray = $this->myBase->toArray();
			$this->assertTrue(is_array($myBaseArray));

		}

		function testSerialize(){
			$json = $this->myBase->serialize();
			$this->assertTrue(is_string($json));
		}

		function tearDown()
		{
			unset($this->myBase);
		}
	}

	class MyBase extends Base{
		protected $name;
		protected $age;
		function getName(){
			return $this->name."getted";
		}

		function getRace(){
			return "human";
		}

		function setName($value){
			$this->name = $value;
		}

	}
}