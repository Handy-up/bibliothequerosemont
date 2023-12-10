<?php

abstract class Controller
{
    protected array $messagesErreur = array();
    protected string $acteur = "visiteur";

    // ******************* Constructeur vide
    public function __construct()
    {
        $this->determinerActeur();
    }

    // ******************* Accesseurs
    public function getMessagesErreur(): array
    {
        return $this->messagesErreur;
    }

    public function getActeur(): string
    {
        return $this->acteur;
    }

    abstract public function executerAction();

    // ****************** Méthode privée
    private function determinerActeur(): void
    {
        session_start();
        if (isset($_SESSION['currentUser'])) {
            $this->acteur = "utilisateur";
        }
    }



}