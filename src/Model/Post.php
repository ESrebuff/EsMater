<?php

namespace MyApp\Model;
use Exception;

require_once 'Model.php';

class Post extends Model {

  // Renvoie la liste des billets du blog
  public function getPosts() {
    $sql = 'select * FROM esmater_post' . ' order by id desc';
    $posts = $this->executeRequest($sql);
    return $posts;
  }

  public function paging($start, $postsPerPages){
    $sql = 'select * FROM esmater_post' . ' order by id desc limit '.$start.','.$postsPerPages;
    $posts = $this->executeRequest($sql);
    return $posts;
  }
    
  // Renvoie les informations sur un post
  public function getPost($idPost) {
    $sql = 'select * FROM esmater_post' . ' where id=:id';
    $post = $this->executeRequest($sql, array('id' => $idPost));
      return $post->fetch();  // Accès à la première ligne de résultat
    }

    // Ajoute un post dans la base
    public function addPost($img, $title, $author, $content, $user_id, $user_avatar) {
    $sql = 'insert into esmater_post(date, title, content, author, user_id, user_avatar, img)' . ' values(NOW(), ?, ?, ?, ?, ?, ?)';
    $post = $this->executeRequest($sql, array($title, $content, $author, $user_id, $user_avatar, $img));
  }
    
    public function getLastPost() {
    $sql = 'SELECT MAX(id) as id' . ' FROM esmater_post' ;
    $post= $this->executeRequest($sql);
    $lastPost = $post->fetch();
    return $lastPost;
  }
    
    public function updateAvatarPost($authId, $img){
        $sql = 'UPDATE esmater_post SET user_avatar = ?' . ' WHERE user_id = ?';
        $req = $this->executeRequest($sql, array($img, $authId));
        return $req;
    }
    
    public function deletePost($idPost){
        $sql = 'DELETE FROM esmater_post' . ' WHERE id = :id';
        $req = $this->executeRequest($sql, array('id' => $idPost));
        return $req;
    }
    
    public function updatePostAndImg($img, $title, $content, $postId){
        $sql = 'UPDATE esmater_post SET title = ?, content = ?, img = ?' . 'WHERE id = ?';
        $req = $this->executeRequest($sql, array($title, $content, $img, $postId));
        return $req;
    }
    
    public function updatePost($title, $content, $postId){
        $sql = 'UPDATE esmater_post SET title = ?, content = ?' . 'WHERE id = ?';
        $req = $this->executeRequest($sql, array($title, $content, $postId));
        return $req;
    }
}
