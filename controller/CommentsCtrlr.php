<?php 

namespace Controller;

use \Model\Article;
use \Model\Comment;

class CommentsCtrlr  {

    public function getComments($id) {
        $req = new Comment;
        $comments = $req->getComment($id);
        return $comments; 
    }

    public function checkComment() {
        if ( !empty($_POST['userName']) && !empty($_POST['comment']) && isset($_POST["g-recaptcha-response"])) {
            $recaptcha = new \ReCaptcha\ReCaptcha("6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe");
            $resp = $recaptcha->verify($_POST["g-recaptcha-response"]);
            if ($resp->isSuccess()) {
                $req = new Comment;
                $req->addComment();
            } 
        }
        header('Location: index.php?action=post&id=' . $_POST['postID'] . '#redirCom');
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
        session_start();
        if ( isset($_SESSION['admin']) ) {
            $req = new Comment;
            $comments = $req->reportedComments();
            $nbReportedComments = $req->countReportedComments();
            require('view/backend/reportedCommentsView.php');
        } else {
            header('Location: index.php?action=forbidden');
        }
    }

    public function legitimateComment($commentId) {
        session_start();
        if ( isset($_SESSION['admin']) && $_SESSION['token'] === $_GET['token'] ) {
            $req = new Comment;
            $req->resetReported($commentId);
            header('Location: index.php?action=reportedComments');       
        } else {
            header('Location: index.php?action=forbidden');
        }
    } 

    public function deleteComment($commentId) {
        session_start();
        if ( isset($_SESSION['admin']) && $_SESSION['token'] === $_GET['token'] ) {
            $req = new Comment;
            $req->deleteComment($commentId);
            if ($_GET['from'] === "reportedComments") {
                header('Location: index.php?action=reportedComments');
            } else if ($_GET['from'] === "post") {
                header('Location: index.php?action=post&id=' . $_GET['id']);
            } else if ($_GET['from'] === "listComments") {
                header('Location: index.php?action=listComment&id=' . $_GET['id']);
            }
            /*
            echo "<p>Commentaire supprimé.</p> 
            <a href='index.php?action=administration'>Administration</a> |
            <a href='index.php?action=reportedComments'>Commentaires signalés</a>";
            */
        } else {
            header('Location: index.php?action=forbidden');
        }
    }

}