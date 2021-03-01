<?php

namespace MyApp\View;
use Exception;
class View{
    
  // Name of the file associated with the view
  private $fileData;
      
  // View title (defined in the view file)
  private $title;
  private $tiny;
 
  public function __construct($action) {
      
    // Determining the name of the file seen from the action
    $this->fileData = "src/View/view" . $action . ".php";
  }

  // Generate and display the view
  public function generate($data) {
      
    // Generation of the specific part of the view
    $content = $this->generateFile($this->fileData, $data);
      
    // Generation of the common template using the specific part
    $view = $this->generateFile('src/View/template.php',
      array('title' => $this->title, 'tiny' => $this->tiny, 'content' => $content));
      
    // Returning the view to the browser
    echo $view;
  }

  // Generate a view file and return the result produced
  private function generateFile($fileData, $data) {
    if(file_exists($fileData)) {
        
      // Makes the elements of the $ data array accessible in the view
      extract($data);
        
      // Start of exit delay
      ob_start();
        
      // Include view file
      // Its result is placed in the output buffer
      require $fileData;
        
      // Stopping the timer and resending the output buffer
      return ob_get_clean();
    }
    else {
      throw new \Exception("Fichier $fileData introuvable");
    }
  }
}