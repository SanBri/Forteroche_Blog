<?php 

require_once('controller/viewsCtrlr.php');

class Home { 

    public function redirection() {
        $req = new Controller;
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