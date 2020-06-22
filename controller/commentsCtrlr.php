<?php 


class CommentCtrlr  {

    public function getComments($id) {
        $req = new Comment;
        $comments = $req->getComment($id);
        return $comments;
    }

    public function checkComment() {
        if ( !empty($_POST['userName']) && !empty($_POST['comment']) ) {
            $req = new Comment;
            $req->addComment();
            header('Location: index.php?action=post&id=' . $_POST['postID'] . '#redirCom');
        } else {
            header('Location: index.php?action=post&id=' . $_POST['postID']);
        }
    }

    public function reportComment($commentId) {
        session_start();
        if ($_SESSION['"'.$commentId.'"'] === $commentId) { 
            echo '<p>Vous avez déjà signalé ce commentaire.</p> 
            <a href="index.php?action=post&amp;id='.$_GET["id"].'">Retour</a>
            ';
        } else {
            $req = new Comment;
            $req->addReportedComment($commentId);
            $_SESSION['"'.$commentId.'"'] = $commentId;
            header("Location: index.php?action=post&id=" . $_GET['id'] );
        }
    }

    public function cancelReportComment($commentId) {
        session_start();
        if ($_SESSION['"'.$commentId.'"'] === $commentId) { 
            $req = new Comment;
            $req->removeReportedComment($commentId);
            $_SESSION['"'.$commentId.'"'] = null;
            header("Location: index.php?action=post&id=" . $_GET['id'] );
        } else { 
            echo '<p>Vous n\'aviez pas signalé ce commentaire.</p>' .      
            ' <a href="index.php?action=post&amp;id='. $_GET["id"] . '">Retour</a>';
        }
    }

    public function showReportedComments() {
            $req = new Comment;
            $comments = $req->reportedComments();
            $nbReportedComments = $req->countReportedComments();
            require('view/backend/reportedCommentsView.php');
    }

    public function legitimateComment($commentId) {
            $req = new Comment;
            $req->resetReported($commentId);
            header('Location: index.php?action=reportedComments');
    }


}



