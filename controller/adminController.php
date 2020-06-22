<?php


class AdminCtrlr {
    
    public function adminCheck() {
        if ( $_POST['login'] === 'sandro' && $_POST['password'] === 'admin' ) {
            session_start();
            $_SESSION['admin'] = $_POST['login'];
            header('Location: index.php');
        } else {
            header('Location: index.php?action=connexion');
        }
    }

    public function deconnexion() {
        session_start();
        session_destroy();
        header('Location: Index.php');
    }

    public function accessCheck($url) {
        session_start();
        if ( isset($_SESSION['admin']) ) {
            $req = new Article;
            if( isset($_GET['page']) && $_GET['page'] > 1 ){
                $currentPage = (int)$_GET['page'];
            } else {
                $currentPage = 1;
            }        
            $perPage = 2;
            $offset = $perPage * ($currentPage - 1);
            if ( isset($_GET['page']) && $_GET['page'] > $pages) {
                $currentPage = $pages;
            }
            $req = new Article;
            $posts = $req->getPosts($perPage, $offset);
            $nbPosts = $req->countPost();
            $pages = ceil($nbPosts / $perPage); //ceil() arrondit au supérieur
            $reqCom = new Comment;
            $nbReportedComments = $reqCom->countReportedComments();
            require($url);
        } else {
            header('Location: Index.php');
        }
    }

    public function add() {
        session_start();
        if ( isset($_SESSION['admin']) ) {
            $req = new Article;
            $req->addPost();
            header('Location: index.php?action=administration');
        } else {
            header('Location : Index.php');
        }
    }

    public function deletePost($postId) {
        session_start();
        if ( isset($_SESSION['admin']) ) {
            $req = new Article;
            $req->deletePost($postId);
            $reqCom = new Comment;
            $reqCom->deleteAllComments($postId);
            echo ("<p>Article supprimé</p> <p><a href='Index.php?action=administration'>Retour à l'administration</a></p> "); 
        } else {
            header('Location : Index.php');
        }
    }

    public function deleteComment($commentId) {
        session_start();
        if ( isset($_SESSION['admin']) ) {
            $req = new Comment;
            $req->deleteComment($commentId);
            echo ("<p>Commentaire supprimé</p> <p><a href='Index.php'?action=administration'>Retour à l'administration</a></p>");
        } else {
            header('Location: Index.php');
        }
    }

}

?>