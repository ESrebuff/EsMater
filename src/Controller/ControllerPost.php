<?php

namespace MyApp\Controller;

class ControllerPost {

    private $post;
    private $comment;
    private $booking;
    private $tools;

    public function __construct() {
        $this->post = new \MyApp\Model\Post();
        $this->comment = new \MyApp\Model\Comment();
        $this->booking = new \MyApp\Model\Booking();
        $this->tools = new \MyApp\Tools\Tools();
    }

  // Show the details of a post
    public function post($idPost) {
        $post = $this->post->getPost($idPost);
        $comments = $this->comment->getComments($idPost);
        $view = new \MyApp\View\View("Post");
        $view->generate(array('post' => $post, 'comments' => $comments));
    }
    
  // Paging the post
    public function page($number){
        $posts = $this->post->getPosts();
        $totalPosts = $posts->rowCount();
        $postsPerPages = 10;
        $start = ($number-1)*$postsPerPages;
        $allPosts = ceil($totalPosts/$postsPerPages);
        $currentPosts = $this->post->paging($start, $postsPerPages);
        $result = $currentPosts->rowCount();
        if($result == 0){
            $msgError = "Cette page n'existe pas";
            $view = new \MyApp\View\View("Error");
            $view->generate(array('msgError' => $msgError));
        } else if ($number == 1) {
            $view = new \MyApp\View\View("Posts");
            $view->generate(array('posts' => $currentPosts, 'allPosts' => $allPosts, 'number' => $number));
        } else {
            $view = new \MyApp\View\View("Posts");
            $view->generate(array('posts' => $currentPosts, 'allPosts' => $allPosts));   
        }
        
    }
    
  // Add a comment to a post
    public function comment($author, $content, $idPost, $user_id, $user_avatar) {
        // Sauvegarde du commentaire
        $this->comment->addComment($author, $content, $idPost, $user_id, $user_avatar); 
        // Actualisation de l'affichage du billet
        $this->Post($idPost);
    }
    
// Add a post with his img  
    public function addPost($img, $title, $author, $content, $user_id, $user_avatar){
        $maxSize = 10485760;
        $ext = strtolower(substr(strrchr($img['name'], '.'), 1));
        $allow_ext = array('jpg', 'jpeg', 'gif', 'png');
        if($img['size'] <= $maxSize){
            if(in_array($ext, $allow_ext)){
                $posts = $this->post->getLastPost();
                if($posts){
                    $postId = $posts['id'] + 1;
                } else {
                    $postId = 1;
                }
                $nameImg = $postId . "." . $ext;
                $result = move_uploaded_file($img['tmp_name'], "src/Content/images/posts/" . $nameImg);
                if($result){
                    $this->post->addPost($nameImg, $title, $author, $content, $user_id, $user_avatar);
                    $lastPost = $this->post->getLastPost();
                    $idPost = $lastPost['id'];
                    $this->Post($idPost);
                } else{
                    $this->tools->flashMessage("danger", "Erreur durant l'importation de votre image", "AddPost");
                }
            } else{
                $this->tools->flashMessage("danger", "Votre fichier doit être au format jpg, jpeg, gif ou png", "AddPost");
            }
        } else{
            $this->tools->flashMessage("danger", "Votre image ne dois pas dépasser 10Mo", "AddPost");
        }
    }
    
    // Show the page for edit a post with the post to edit in parameter
    public function editPost($idPost, $user_id) {
        $post = $this->post->getPost($idPost);
        if($post){
            if($post['user_id'] == $user_id){
                $view = new \MyApp\View\View("EditPost");
                $view->generate(array('post' => $post));
            }
        } else{
            $this->Post($idPost);
        }       
    }
    
    // Update the post and the img
    public function updatePostAndImg($postId, $title, $content, $userId, $img){
        $post = $this->post->getPost($postId);
        if($userId == $post['user_id']){
            $maxSize = 10485760;
            $ext = strtolower(substr($img['name'],-3));
            $allow_ext = array('jpg', 'jpeg',  'gif', 'png');
            if($img['size'] <= $maxSize){
                if(in_array($ext, $allow_ext)){
                    $nameImg = $post['id'] . "." . $ext;
                    $result = move_uploaded_file($img['tmp_name'], "src/Content/images/posts/".$nameImg);
                    if($result){
                        $this->post->updatePostAndImg($nameImg, $title, $content, $postId);
                        $booking = $this->booking->getBookedByPostId($postId);
                            if($booking){
                                $this->booking->updateBookingAndImg($title, $nameImg, $postId);
                            }
                        $this->Post($postId);
                    } else{
                        $this->tools->flashMessage("danger", "Erreur durant l'importation de votre image", "AddPost");
                    }
                } else{
                    $this->tools->flashMessage("danger", "Votre fichier doit être au format jpg, jpeg, gif ou png", "AddPost");
                }
            } else{
                $this->tools->flashMessage("danger", "Votre image ne dois pas dépasser 10Mo", "AddPost");
            }
        
        }
    }
    
    // Update the post without the img
    public function updatePost($postId, $title, $content, $userId){
        $post = $this->post->getPost($postId);
        $this->post->updatePost($title, $content, $postId);
        $booking = $this->booking->getBookedByPostId($postId);
        if($booking){
            $this->booking->updateBooking($title, $postId);
        }
        $this->Post($postId);
    }
        
    // Delete a comment
    public function deleteComment($idComment, $user, $idPost){
        $comments = $this->comment->getComment($idComment);
        if($comments){
            if($comments['user_id'] == $user['id'] || $user['role'] == 'admin'){
            $delete = $this->comment->deleteComment($idComment);
                if($delete){
                    echo json_decode($idComment);
                }
            } else {
                $msgError = "Vous n'avez pas cette autorisation";
                $view = new \MyApp\View\View("Error");
                $view->generate(array('msgError' => $msgError));
            }
        } else{
            $this->Post($idPost);
        }
    }
    
    // Show the page for edit a comment with the comment to edit in parameter
    public function editComment($idPost, $idComment, $user_id) {
        $updateComment = $this->comment->getComment($idComment);
        if($updateComment){
            if($updateComment['user_id'] == $user_id){
                $post = $this->post->getPost($idPost);
                $comments = $this->comment->getComments($idPost);
                $view = new \MyApp\View\View("EditComment");
                $view->generate(array('post' => $post, 'comments' => $comments, 'updateComment' => $updateComment));
            }
        } else{
            $this->Post($idPost);
        }   
    }
    
    // Update the comment
    public function updateComment($content, $idComm, $idPost) {
        $this->comment->editComment($content, $idComm); 
        $this->Post($idPost);
    }
    
    // Delete the post
    public function deletePost($user_id, $idPost){
        $post = $this->post->getPost($idPost);
        if($post){
            if($post['user_id'] == $user_id){
            $delete = $this->post->deletePost($idPost);
                if($delete){
                    $booking = $this->booking->deleteBooking($idPost);
                    header('Location: index.php?action=page&number=1');
                }
            } else {
                $msgError = "Vous n'avez pas cette autorisation";
                $view = new \MyApp\View\View("Error");
                $view->generate(array('msgError' => $msgError));
            }
        } else{
            $this->Post($idPost);
        }
    }
    
    // Add a booking with a pseudo key for being uniq
    public function addBooking($idPost, $user){
        $post = $this->post->getPost($idPost);
        $strIdPost = (string)$post['id'];
        $strIdUser = (string)$user['id'];
        $mixedId = $strIdPost . $strIdUser;
        $req = $this->booking->getBookedByMixed($mixedId);
        if(!$req){
            $this->booking->addBooked($idPost, $user['id'], $user['username'], $mixedId, $post['img'], $post['title'], $post['date']);
            $_SESSION['flash']['success'] = "Vous êtes maintenant inscris à cette activitée";
            $this->Post($idPost);
        } else {
            $_SESSION['flash']['danger'] = "Vous êtes déjà inscris à cette activitée";
            $this->Post($idPost);
        }
    }
    
    public function lastPost($error){
        if($error) {
            $lastPost = $this->post->getLastPost();
            $idPost = $lastPost['id'];
            $post = $this->post->getPost($idPost);
            $view = new \MyApp\View\View("Home");
            $view->generate(array('post' => $post, 'error' => $error));
        } else {
            $lastPost = $this->post->getLastPost();
            $idPost = $lastPost['id'];
            $post = $this->post->getPost($idPost);
            $view = new \MyApp\View\View("Home");
            $view->generate(array('post' => $post));
        } 
        
    }
}