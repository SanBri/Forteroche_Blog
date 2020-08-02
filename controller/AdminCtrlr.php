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

    public function registerAccess() {
        session_start();
        if ( isset($_SESSION['admin']) ) {
            require('view/backend/registerView.php');
        } else {
            header('Location: index.php?action=forbidden');
        }   
    }

    public function addAdmin() {
        session_start();
        if ( isset($_SESSION['admin']) ) {
                if ( !empty($_POST['login']) && !empty($_POST['password']) ) {
                $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $req = new Admin;
                $req->register($_POST['login'], $pass_hache);
                echo 'Ce compte a bien été créé !';
            } else {
                echo 'Veuillez renseigner tous les champs';
            }   
        } else {
            header('Location: index.php?action=forbidden');
        }
    }

    public function deconnexion() {
        session_start();
        session_destroy();
        header('Location: index.php');
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
            $nbPosts = $req->countPosts();
            $pages = ceil($nbPosts / $perPage); //ceil() arrondit au supérieur
            $reqCom = new Comment;
            $nbReportedComments = $reqCom->countReportedComments();
            if ( isset($_GET['page']) && $_GET['page'] > $pages) {
                $currentPage = $pages;
            }
            require($url);
        } else {
            header('Location: index.php?action=forbidden');
        }
    }



}

?>