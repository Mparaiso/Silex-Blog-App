<?php
namespace App\Model\Manager{
  use App\Model\Entity\Option;
  interface IOptionManager{


    /**
     * return \MongoCursor
     */
    function getAll();

    /**
     * @return array
     */
    function getByName($name);

    /**
     * @return mixed
     */
    function get($name);

    /**
     * @return array
     */
    function getById($id);

    function set(Option $option);
  }
}