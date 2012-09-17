<?php
namespace Net\Mpmedia\Http{
  /**
   * @copyright 2009 M.PARAISO
   */
  interface IHttpClient{
    function configure(array $options);
    function send();
  }
}