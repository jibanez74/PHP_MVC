<?php

class Controller {
  //laod the model
  public function model ($model) {
    //requie the model file
    require_once("../app/models/" . $model . ".php");

    //instantiate the model
    return new $model();
  }

  //check for a view
  public function view ($view, $data = []) {
    if (file_exists("../app/views/" . $view . ".php")) {
      require_once("../app/views/" . $view . ".php");
    } else {
      //in case there is no such view
      die ("This view does not exist!");
    }
  }
}