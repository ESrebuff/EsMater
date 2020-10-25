<?php

require_once 'Model/Model.php';

class Comment extends Model {

    // Renvoie la liste des commentaires associés à un billet
    public function getComments($idPost) {
    $sql = 'select * FROM t_comment'
      . ' where post_id=?';
    $comments = $this->executeRequest($sql, array($idPost));
    return $comments;
  }
    
    // Renvoie les informations sur un comment
    public function getComment($idComment) {
    $sql = 'select * FROM t_comment'
      . ' where id=?';
    $comment = $this->executeRequest($sql, array($idComment));
    if ($comment->rowCount() == 1)
      return $comment->fetch();  // Accès à la première ligne de résultat
    else
      return $comment = false;
    }
    
    // Ajoute un commentaire dans la base
    public function addComment($author, $content, $idPost, $user_id, $user_avatar) {
    $sql = 'insert into t_comment(date, author, content, post_id, user_id, user_avatar)'
      . ' values(NOW(), ?, ?, ?, ?, ?)';
    $this->executeRequest($sql, array($author, $content, $idPost, $user_id, $user_avatar));
  }
    
    public function updateAvatarComment($user_id, $img){
        $sql = 'UPDATE t_comment SET user_avatar = ?' . ' WHERE user_id = ?';
        $req = $this->executeRequest($sql, array($img, $user_id));
        return $req;
    }
    
    public function deleteComment($idComment){
        $sql = 'DELETE FROM t_comment' . ' WHERE id = ?';
        $req = $this->executeRequest($sql, array($idComment));
        return $req;
    }
    
    public function editComment($content, $idComm){
        $sql = 'UPDATE t_comment SET content = ?' . ' WHERE id = ?';
        $req = $this->executeRequest($sql, array($content, $idComm));
        return $req;
    }
}
