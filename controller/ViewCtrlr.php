<?php

namespace Controller;

use \Model\Article;
use \Model\Comment;

class ViewCtrlr {

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
        $comReq = new CommentCtrlr;
        $comments = $comReq->getComments($_GET['id']);
        if ($post) {
            require('view/frontend/postView.php');
        } else {
            require('view/frontend/unknownPostView.php');
        }
    }
    
}

