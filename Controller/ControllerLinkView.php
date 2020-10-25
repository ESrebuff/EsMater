<?php

require_once 'View/View.php';

class ControllerLinkView {

  // Affiche la liste de tous les billets du blog
  public function linkView($view) {
    $view = new view($view);
    $view->generate(array());
  }
    
}