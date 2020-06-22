<?php 

require('vendor/autoload.php');

use \Controller\ViewCtrlr;
use \Controller\CommentCtrlr;
use \Controller\AdminCtrlr;


class Home { 
    public function redirection() {
        $req = new ViewCtrlr;
        $commentReq = new CommentCtrlr;
        $adminReq = new AdminCtrlr;
        if(isset($_GET['action'])) {
            $action = $_GET['action'];
            if ($action === 'post') {
                if ( isset($_GET['id']) && $_GET['id'] > 0 ) {
                    $req->showPost();
                    $id = $_GET['id'];
                    return $id;
                } else {
                    require('view/frontend/unknownPostView.php');
                }
            } else if ($action === 'postComment') {
                $commentReq->checkComment();
            } else if ($action === 'connexion') {
                require('view/frontend/connexionView.php');
            } else if ($action === 'checkConnexion') {
                $adminReq->adminCheck();
            } else if ($action === 'deconnexion') {
                $adminReq->deconnexion();
                $req->listPosts();
            } else if ($action === 'administration') {
                $adminReq->accessCheck('view/backend/adminView.php');
            } else if ($action === 'deletePost') {
                $adminReq->deletePost($_GET['id']);
            } else if ($action === 'createPost') {
               require('view/backend/addPostView.php');
            } else if ($action === 'newPost') {
                $adminReq->add();
            } else if ($action === 'listComment') {
                $comments = $commentReq->getComments($_GET['id']);
                require('view/backend/listCommentsView.php');
            } else if ($action === 'deleteComment') {
                $adminReq->deleteComment($_GET['comId']);
            } else if ($action === 'reportComment') {
                $commentReq->reportComment($_GET['comId']);
            } else if ($action === 'cancelReportComment') {
                $commentReq->cancelReportComment($_GET['comId']);
            } else if ($action === 'reportedComments') {
                $comments = $commentReq->showReportedComments();
            } else if ($action === 'legitimateComment') {
                $commentReq->legitimateComment($_GET['comId']);
            } else if ($action === 'register') {
                $adminReq->register();
            } else {
                $req->listPosts();
            }
        } else {
            $req->listPosts();
        } 
    }

}

$index = new Home;
$index->redirection();