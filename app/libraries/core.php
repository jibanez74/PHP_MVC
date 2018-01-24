<?php

/*
This is the main class for framework
It It will create the url and load the corresponding controller
* URL FORMAT - /controller/method/params
*/

class Core {
  protected $currentController = "Pages";
  protected $currentMethod = "index";
  protected $params = [];

  public function __construct () {
    $url = $this->getUrl();
    
    //look in the controllers for the first value
    if (file_exists("../app/controllers/" . ucwords($url[0]).".php")) {
      //if it does exist, set as controller
      $this->currentController = ucwords($url[0]);
      unset($url[0]);
    }

    //require the controller
    require_once("../app/controllers/". $this->currentController .".php");

    //instantiate the controller
    $this->currentController = new $this->currentController;

    //check for 2nd part of url which is the method
    if (isset($url[1])) {
      //verify that the methods exists in the controller
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
        unset($url[1]);
      }
    }

    //get params
    $this->params = $url ? array_values($url) : [];
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getUrl () {
    if (isset($_POST["url"])) {
      $url = rtrim($_get["url"], "/");
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode("/", $url);
      return $url;
    }
  }
}