<?php

namespace MyApp\View;
use Exception;
class View{
    
  // Nom du fichier associé à la vue
  private $fileData;
      
  // Titre de la vue (défini dans le fichier vue)
  private $title;
  private $tiny;
 
  public function __construct($action) {
      
    // Détermination du nom du fichier vue à partir de l'action
    $this->fileData = "src/View/view" . $action . ".php";
  }

  // Génère et affiche la vue
  public function generate($data) {
      
    // Génération de la partie spécifique de la vue
    $content = $this->generateFile($this->fileData, $data);
      
    // Génération du gabarit commun utilisant la partie spécifique
    $view = $this->generateFile('src/View/template.php',
      array('title' => $this->title, 'tiny' => $this->tiny, 'content' => $content));
      
    // Renvoi de la vue au navigateur
    echo $view;
  }

  // Génère un fichier vue et renvoie le résultat produit
  private function generateFile($fileData, $data) {
    if(file_exists($fileData)) {
        
      // Rend les éléments du tableau $donnees accessibles dans la vue
      extract($data);
        
      // Démarrage de la temporisation de sortie
      ob_start();
        
      // Inclut le fichier vue
      // Son résultat est placé dans le tampon de sortie
      require $fileData;
        
      // Arrêt de la temporisation et renvoi du tampon de sortie
      return ob_get_clean();
    }
    else {
      throw new \Exception("Fichier $fileData introuvable");
    }
  }
}