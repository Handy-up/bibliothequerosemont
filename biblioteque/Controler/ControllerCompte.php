<?php

class Compte extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->messagesErreur = [0];
    }

    public function executerAction()
    {
        return "compte";
    }
}