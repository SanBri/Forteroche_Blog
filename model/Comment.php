<?php 

class Comment extends Article {

    public function getComment($postId) {
        $dbComments = parent::dbConnect();
        $req = $dbComments->prepare(
        "SELECT id, id_posts, author, comment, DATE_FORMAT(creation_date, 'le %d/%m/%Y à %H:%i') AS creation_date_fr FROM comments WHERE id_posts = $postId ORDER BY creation_date_fr DESC ");
        $req->execute(array($postId));
        return $req;
    }

    public function addComment() {
        $dbComments = parent::dbConnect();
        $req = $dbComments->prepare( "INSERT INTO comments(id_posts, author, comment, creation_date) VALUES(?, ?, ?, ?)" );
        $req->execute( array($_POST['postID'], $_POST['userName'], $_POST['comment'], date('Y-m-d H:i:s')) );
        return $req;
    }


}

