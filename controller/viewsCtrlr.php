<?php

require_once('model/Article.php');
require_once('model/Comment.php');


class Controller {

    public function listPosts() {
        $req = new Article;
        $posts = $req->getPosts();
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

