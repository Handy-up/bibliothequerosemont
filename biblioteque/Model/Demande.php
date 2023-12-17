<?php

class Demande
{
    private int $id_demande;
    private int $id_detenteur;
    private int $id_demandeur;
    private int $statu_demande;
    private int $id_livre_demande;
    private String $date_envoie;

    public function __construct(int $id_demande, int $id_demandeur, int $id_detenteur, int $statu_demande, String $date_envoie)
    {
        $this->id_demande = $id_demande;
        $this->id_demandeur = $id_demandeur;
        $this->id_detenteur = $id_detenteur;
        $this->statu_demande = $statu_demande;
        $this->date_envoie = $date_envoie;
    }

    public function getIdDemande(): int
    {
        return $this->id_demande;
    }

    public function setIdDemande(int $id_demande): void
    {
        $this->id_demande = $id_demande;
    }

    public function getIdDetenteur(): int
    {
        return $this->id_detenteur;
    }

    public function setIdDetenteur(int $id_detenteur): void
    {
        $this->id_detenteur = $id_detenteur;
    }

    public function getIdDemandeur(): int
    {
        return $this->id_demandeur;
    }

    public function setIdDemandeur(int $id_demandeur): void
    {
        $this->id_demandeur = $id_demandeur;
    }

    public function getStatuDemande(): int
    {
        return $this->statu_demande;
    }

    public function setStatuDemande(int $statu_demande): void
    {
        $this->statu_demande = $statu_demande;
    }

    public function getIdLivreDemande(): int
    {
        return $this->id_livre_demande;
    }

    public function setIdLivreDemande(int $id_livre_demande): void
    {
        $this->id_livre_demande = $id_livre_demande;
    }

    public function getDateEnvoie(): string
    {
        return $this->date_envoie;
    }

    public function setDateEnvoie(string $date_envoie): void
    {
        $this->date_envoie = $date_envoie;
    }

    public function isComplet():bool
    {
        if ($this->statu_demande ==0){
            return true;
        }else{
            return false;
        }
    }


}