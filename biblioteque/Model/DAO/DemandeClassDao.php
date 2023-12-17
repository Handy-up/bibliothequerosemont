<?php
include_once ("DAODemande.php");

class DemandeClassDao implements DAODemande
{

    static public function showAllRequest(): array
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        $query = $con->prepare("SELECT * FROM bibliotheque_departemental.Demande");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $requests = array();
        foreach ($data as $row) {
            $demande = new Demande(
                $row['id_demande'],
                $row['detenteur_actuel'],
                $row['demandeur'],
                $row['statut'],
                $row['date_demande']
            );
            $requests[] = $demande;
        }

        $query->closeCursor();
        ConnexionBD::fermerConnexion();

        return $requests;
    }

    static public function showForDemande($id_detanteur): array
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        $query = $con->prepare("SELECT * FROM bibliotheque_departemental.Demande WHERE detenteur_actuel = ?");
        $query->execute([$id_detanteur]);
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $demandes = array();
        foreach ($data as $row) {
            $demande = new Demande(
                $row['id_demande'],
                $row['demandeur'],
                $row['detenteur_actuel'],
                $row['statut'],
                $row['date_demande']
            );
            $demandes[] = $demande;
        }

        $query->closeCursor();
        ConnexionBD::fermerConnexion();

        return $demandes;
    }

    static public function showIfDemande($conditions)
    {
        // TODO: Implement showIfDemande() method.
    }

    static public function updateDemande($id_demande): void
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        $query = $con->prepare("UPDATE bibliotheque_departemental.Demande SET statut = 1 WHERE id_demande = ?");
        $query->execute([$id_demande]);

        $query->closeCursor();
        ConnexionBD::fermerConnexion();
    }

    static public function deleteDemande($id_demande): void
    {
        try {
            $con = ConnexionBD::getInstanceT();
        } catch (Exception $e) {
            throw new Exception("Connexion Impossible " . $e);
        }

        $query = $con->prepare("DELETE FROM bibliotheque_departemental.Demande WHERE id_demande = ?");
        $query->execute([$id_demande]);

        $query->closeCursor();
        ConnexionBD::fermerConnexion();
    }
}