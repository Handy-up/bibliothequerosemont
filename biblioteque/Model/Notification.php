<?php

class Notification {
      private $dateEnvoi;
    private $destinataire;
    private $contenu;
    private $consultation;

    public function __construct($dateEnvoi, $destinataire, $contenu, $consultation) {
        $this->dateEnvoi = $dateEnvoi;
        $this->destinataire = $destinataire;
        $this->contenu = $contenu;
        $this->consultation = $consultation;
    }

    public function getDateEnvoi() {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi($dateEnvoi) {
        $this->dateEnvoi = $dateEnvoi;
    }

    public function getDestinataire() {
        return $this->destinataire;
    }

    public function setDestinataire($destinataire) {
        $this->destinataire = $destinataire;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function getConsultation() {
        return $this->consultation;
    }

    public function setConsultation($consultation) {
        $this->consultation = $consultation;
    }
}
?>