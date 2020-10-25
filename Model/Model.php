<?php

abstract class Model {

  // Objet PDO d'accès à la BD
  private $bdd;

  // Exécute une requête SQL éventuellement paramétrée
  protected function executeRequest($sql, $settings = null) {
    if ($settings == null) {
      $result = $this->getBdd()->query($sql);    // exécution directe
    }
    else {
      $result = $this->getBdd()->prepare($sql);  // requête préparée
      $result->execute($settings);
    }
    return $result;
  }

  // Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
  private function getBdd() {
    if ($this->bdd == null) {
      // Création de la connexion
      $this->bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8',
        'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    return $this->bdd;
  }

}