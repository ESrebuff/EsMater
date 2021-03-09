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
        $date = $this->tools->date($post);
        $this->tools->sessionOn();
        if(isset($_SESSION['auth'])){
            $user = $_SESSION['auth'];
            $booking = $this->booking->getBookedByMixed($idPost . $user['id']);
            if($booking){
                $view = new \MyApp\View\View("Post");
                $view->generate(array('post' => $post, 'comments' => $comments, 'date' => $date, 'booking' => $booking));
            }
        } else {
            $view = new \MyApp\View\View("Post");
            $view->generate(array('post' => $post, 'comments' => $comments, 'date' => $date));
        }
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
        $this->tools->sessionOn();
        if($result == 0){
            $msgError = "Cette page n'existe pas ou il n'y a pas d'activité actuellement";
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
                    $_SESSION['flash']['danger'] = "Erreur durant l'importation de votre image";
                    $this->tools->redirectionAccount($_SESSION["auth"]['id']);
                }
            } else{
                $_SESSION['flash']['danger'] = "Votre fichier doit être au format jpg, jpeg, gif ou png";
                $this->tools->redirectionAccount($_SESSION["auth"]['id']);
            }
        } else{
            $_SESSION['flash']['danger'] = "Votre image ne dois pas dépasser 10Mo";
            $this->tools->redirectionAccount($_SESSION["auth"]['id']);
        }
    }
    
    // Show the page for edit a post with the post to edit in parameter
    public function editPost($idPost, $user_id) {
        $post = $this->post->getPost($idPost);
        if($post){
            if($post['user_id'] == $user_id){
                $this->tools->logged_auth_only();
                $this->tools->admin_only();
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
                        $_SESSION['flash']['danger'] = "Erreur durant l'importation de votre image";
                        header("Location: index.php?action=editPost&id={$postId}");
                    }
                } else{
                    $_SESSION['flash']['danger'] = "Votre fichier doit être au format jpg, jpeg, gif ou png";
                    header("Location: index.php?action=editPost&id={$postId}");
                }
            } else{
                $_SESSION['flash']['danger'] = "Votre image ne dois pas dépasser 10Mo";
                header("Location: index.php?action=editPost&id={$postId}");
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
                $this->tools->sessionOn();
                $date = $this->tools->date($post);
                $view = new \MyApp\View\View("EditComment");
                $view->generate(array('post' => $post, 'comments' => $comments, 'updateComment' => $updateComment, 'date' => $date));
            } else {
                $this->Post($idPost);
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
                    echo json_decode($idPost);
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
            $this->booking->addBooked($idPost, $user['id'], $user['username'], $user['avatar'], $mixedId, $post['img'], $post['title'], $post['date']);
            $_SESSION['flash']['success'] = "Vous êtes maintenant inscrit à cette activité";
            $this->Post($idPost);
        } else {
            $_SESSION['flash']['danger'] = "Vous êtes déjà inscrit à cette activité";
            $this->Post($idPost);
        }
    }
    
    public function deleteBooking($booking_id){
        $booking = $this->booking->deleteBooking($booking_id);
        if($booking) {
            echo  json_decode($booking_id);
        }
    }
    
    public function errorRedirection($error, $page, $notif){
        if($notif) {
            $this->tools->sessionOn();
            $_SESSION['flash']['success'] = $notif;
        }
        if($error) {
            $lastPost = $this->post->getLastPost();
            $idPost = $lastPost['id'];
            $post = $this->post->getPost($idPost);
            $$this->tools->logged_auth_only();
            $view = new \MyApp\View\View($page);
            $view->generate(array('post' => $post, 'error' => $error));
        } else {
            $lastPost = $this->post->getLastPost();
            $idPost = $lastPost['id'];
            $post = $this->post->getPost($idPost);
            $view = new \MyApp\View\View($page);
            if($post) {
                $date = $this->tools->date($post);
                $view->generate(array('post' => $post, 'date' => $date));
            } else {
                $view->generate(array('post' => $post));
            }
        } 
        
    }
}
