<?php

class Demande
{
    private int $id_demande;
    private int $livre_id;
    private int $demandeur_id;
    private int $detenteur_actuel_id;
    private string $statut_demande;
    private string $date_demande;

    public function __construct(
        int $id_demande,
        int $livre_id,
        int $demandeur_id,
        int $detenteur_actuel_id,
        string $statut_demande,
        string $date_demande
    ) {
        $this->id_demande = $id_demande;
        $this->livre_id = $livre_id;
        $this->demandeur_id = $demandeur_id;
        $this->detenteur_actuel_id = $detenteur_actuel_id;
        $this->statut_demande = $statut_demande;
        $this->date_demande = $date_demande;
    }

    public function getIdDemande(): int
    {
        return $this->id_demande;
    }

    public function getLivreId(): int
    {
        return $this->livre_id;
    }

    public function getDemandeurId(): int
    {
        return $this->demandeur_id;
    }

    public function getDetenteurActuelId(): int
    {
        return $this->detenteur_actuel_id;
    }

    public function getStatutDemande(): string
    {
        return $this->statut_demande;
    }

    public function getDateDemande(): string
    {
        return $this->date_demande;
    }

}