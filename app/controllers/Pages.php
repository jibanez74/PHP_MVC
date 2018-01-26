<?php
class Pages extends Controller {
  public function __construct () {

  }

  public function index () {
    $data = [
      "title" => "Welcome"
    ];
    $this->view("pages/index", $data); 
  }

  public function about ($id) {
    $data = [
      "title" => "About"
    ];
    $this->view("pages/about", $data);
  }
}