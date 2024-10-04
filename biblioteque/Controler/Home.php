<?php
include_once "MainController.php";
include_once "Controller.abstract.php";

class Home extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function executerAction(): string
    {
        // AffiCher la home page
        return "home";
    }
}