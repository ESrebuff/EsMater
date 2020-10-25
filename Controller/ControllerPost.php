<?php

require_once 'Model/Post.php';
require_once 'Model/Comment.php';
require_once 'View/View.php';

class ControllerPost {

    private $post;
    private $comment;

    public function __construct() {
        $this->post = new Post();
        $this->comment = new Comment();
    }

  // Affiche les détails sur un billet
    public function post($idPost) {
        $post = $this->post->getPost($idPost);
        $comments = $this->comment->getComments($idPost);
        $view = new View("Post");
        $view->generate(array('post' => $post, 'comments' => $comments));
    }
    
  // Ajoute un commentaire à un billet
    public function comment($author, $content, $idPost, $user_id, $user_avatar) {
        // Sauvegarde du commentaire
        $this->comment->addComment($author, $content, $idPost, $user_id, $user_avatar); 
        // Actualisation de l'affichage du billet
        $this->Post($idPost);
    }
    
// Ajoute un post avec sont image    
    public function addPost($img, $title, $author, $content, $user_id, $user_avatar){
        $maxSize = 10485760;
        $ext = strtolower(substr($img['name'],-3));
        $allow_ext = array('jpg', 'jpeg',  'gif', 'png');
        if($img['size'] <= $maxSize){
            if(in_array($ext, $allow_ext)){
                $result = move_uploaded_file($img['tmp_name'], "Content/images/posts/".$img['name']);
                if($result){
                    $this->post->addPost($img['name'], $title, $author, $content, $user_id, $user_avatar);
                    $posts = $this->post->getLastPost();
                    $idPost = $posts['id'];
                    $this->Post($idPost);
                } else{
                    session_start();
                    $_SESSION['flash']['danger'] = "Erreur durant l'importation de votre image";
                    header('Location: index.php?action=linkView&swicthTo=AddPost');
                }
                
            } else{
                session_start();
                $_SESSION['flash']['danger'] = "Votre fichier doit être au format jpg, jpeg, gif ou png";
                header('Location: index.php?action=linkView&swicthTo=AddPost');
            }
        } else{
            session_start();
            $_SESSION['flash']['danger'] = "Votre image ne dois pas dépasser 10Mo";
            header('Location: index.php?action=linkView&swicthTo=AddPost');
        }
    }
    
    public function deleteComment($idComment, $user_id, $idPost){
        $comments = $this->comment->getComment($idComment);
        if($comments){
            if($comments['user_id'] == $user_id){
            $delete = $this->comment->deleteComment($idComment);
                if($delete){
                    $this->Post($idPost);
                }
            } else {
                $msgError = "Vous n'avez pas cette autorisation";
                $view = new View("Error");
                $view->generate(array('msgError' => $msgError));
            }
        } else{
            $this->Post($idPost);
        }
    }
    
    public function editComment($idPost, $idComment, $user_id) {
        $updateComment = $this->comment->getComment($idComment);
        if($updateComment){
            if($updateComment['user_id'] == $user_id){
                $post = $this->post->getPost($idPost);
                $comments = $this->comment->getComments($idPost);
                $view = new View("EditComment");
                $view->generate(array('post' => $post, 'comments' => $comments, 'updateComment' => $updateComment));
            }
        } else{
            $this->Post($idPost);
        }
            
    }
    
    public function updateComment($content, $idComm, $idPost) {
        $this->comment->editComment($content, $idComm); 
        $this->Post($idPost);
    }
    
    public function deletePost($user_id, $idPost){
        $post = $this->post->getPost($idPost);
        if($post){
            if($post['user_id'] == $user_id){
            $delete = $this->post->deletePost($idPost);
                if($delete){
                    header('Location: index.php');
                }
            } else {
                $msgError = "Vous n'avez pas cette autorisation";
                $view = new View("Error");
                $view->generate(array('msgError' => $msgError));
            }
        } else{
            $this->Post($idPost);
        }
    }
    
    public function editPost($idPost, $user_id) {
        $post = $this->post->getPost($idPost);
        if($post){
            if($post['user_id'] == $user_id){
                $view = new View("EditPost");
                $view->generate(array('post' => $post));
            }
        } else{
            $this->Post($idPost);
        }
            
    }
}
