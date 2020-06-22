<?php 

class Comment extends Article {

    public function getComment($postId) {
        $dbComments = parent::dbConnect();
        $req = $dbComments->prepare("SELECT id, id_posts, author, comment, DATE_FORMAT(creation_date, 'le %d/%m/%Y à %H:%i') AS creation_date_fr, reported FROM comments WHERE id_posts = $postId ORDER BY id DESC ");
        $req->execute(array($postId));
        return $req;
    }

    public function addComment() {
        $dbComments = parent::dbConnect();
        date_default_timezone_set('Europe/Paris');
        $req = $dbComments->prepare( "INSERT INTO comments(id_posts, author, comment, creation_date) VALUES(?, ?, ?, ?)" );
        $req->execute( array($_POST['postID'], $_POST['userName'], $_POST['comment'], date('Y-m-d H:i:s')) );
        return $req;
    }

    public function deleteComment($commentId) {
        // INSERER MESSAGE DE CONFIRMATION
        $dbComments = parent::dbConnect();
        $req = $dbComments->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($commentId));
    }

    public function deleteAllComments($commentId) {
        $dbComments = parent::dbConnect();
        $req = $dbComments->prepare('DELETE FROM comments WHERE id_posts = ?');
        $req->execute(array($commentId));
    }

    public function addReportedComment($commentId) {
        $dbComments = parent::dbConnect();
        $req = $dbComments->prepare('UPDATE comments SET reported=reported+1 WHERE id = ?');
        $req->execute(array($commentId));
    }

    public function removeReportedComment($commentId) {
        $dbComments = parent::dbConnect();
        $req = $dbComments->prepare('UPDATE comments SET reported=reported-1 WHERE id = ? ');
        $req->execute(array($commentId)); 
        $res = $dbComments->prepare('UPDATE comments SET reported = 0 WHERE reported < 0');
        $res->execute(array($commentId));
    }
    
    public function resetReported($commentId) {
        $dbComments = parent::dbConnect();
        $req = $dbComments->prepare('UPDATE comments SET reported = 0 WHERE id = ?');
        $req->execute(array($commentId));
    }

    public function reportedComments() {
        $dbComments = parent::dbConnect();
        $req = $dbComments->query('SELECT * FROM comments WHERE reported > 0 ORDER BY reported DESC');
        return $req;
    }

    public function countReportedComments() {
        $dbComments = parent::dbConnect();
        $res = $dbComments->query('SELECT COUNT(*) FROM comments WHERE reported > 0 ');
        $nbReportedComments = $res->fetchColumn();
        return $nbReportedComments;
    }

}

