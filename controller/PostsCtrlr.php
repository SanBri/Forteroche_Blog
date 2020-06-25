<?php

namespace Controller;

use \Model\Article;
use \Model\Comment;

class PostsCtrlr {

    public function listPosts() {
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
        if ( isset($_GET['page']) && $_GET['page'] > $pages) {
            $currentPage = $pages;
        }
        require('view/frontend/postsView.php');
    }

    public function showPost() {
        $req = new Article;
        $post = $req->getPost($_GET['id']);
        $comReq = new CommentsCtrlr;
        $comments = $comReq->getComments($_GET['id']);
        if ($post) {
            require('view/frontend/postView.php');
        } else {
            require('view/frontend/unknownPostView.php');
        }
    }

    public function newPost() {
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
            header('Location: index.php?action=forbidden');
        }
    }

    public function showPosttoEdit() {
            $req = new Article;
            $post = $req->getPost($_GET['id']);
            if ($post) {
                require('view/backend/editPostView.php');
            } else {
                require('view/frontend/unknownPostView.php');
            }
    }

    public function editPost($postId) {
        session_start();
        if ( isset($_SESSION['admin']) ) {
                $req = new Article;
                $req->updatePost($postId);
                header('Location: index.php?action=administration');
        } else {
            header('Location: index.php?action=forbidden');
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
            header('Location: index.php?action=forbidden');
        }
    }
    
}

