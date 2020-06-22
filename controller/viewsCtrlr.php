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
        $comments = $this->getComments();
        $nbrs = array_count_values($post);
        if ( $_GET['id'] <= $nbrs ) {
            require('view/frontend/postView.php');
        } else {
            require('view/frontend/unknownPostView.php');
        }
    }

    public function getComments() {
        $req = new Comment;
        $comments = $req->getComment($_GET['id']);
        return $comments;
    }

}

