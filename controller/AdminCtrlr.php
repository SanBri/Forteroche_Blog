<?php

namespace Controller;

use \Model\Article;
use \Model\Comment;
use \Model\Admin;

class AdminCtrlr {
    
    public function adminCheck() {
        $req = new Admin; 
        $res = $req->checkAccount($_POST['login']);
        $passwordChecked = password_verify($_POST['password'], $res['pass']);
        if ($passwordChecked) {
            session_start();
            $_SESSION['admin'] = $_POST['login'];
            header('Location: index.php');
        } else {
            header('Location: index.php?action=connexion');
        }
    }

    public function register() {
        if ( !empty($_POST['login']) && !empty($_POST['password']) ) {
            $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $req = new Admin;
            $req->register($_POST['login'], $pass_hache);
            echo 'Ce compte a bien été créé !';
        } else {
            echo 'Veuillez renseigner tous les champs';
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
            $req = new Article;
            $posts = $req->getPosts($perPage, $offset);
            $nbPosts = $req->countPost();
            $pages = ceil($nbPosts / $perPage); //ceil() arrondit au supérieur
            $reqCom = new Comment;
            $nbReportedComments = $reqCom->countReportedComments();
            if ( isset($_GET['page']) && $_GET['page'] > $pages) {
                $currentPage = $pages;
            }
            require($url);
        } else {
            header('Location: Index.php');
        }
    }

    public function add() {
        session_start();
        if ( isset($_SESSION['admin']) ) {
            if ( !empty($_POST['title']) && !empty($_POST['content']) ) { 
                $req = new Article;
                $req->addPost();
                header('Location: index.php?action=administration');
            } else {
                echo '<p>Veuillez renseigner les champs !</p>
                <p><a href="index.php?action=createPost"><input type="button" value="Retour" class="bttn"></a></p>';
            }
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