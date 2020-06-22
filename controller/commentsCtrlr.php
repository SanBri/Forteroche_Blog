<?php 

class commentCtrlr  {

    public function checkComment() {
        if ( !empty($_POST['userName']) && !empty($_POST['comment']) ) {
            $req = new Comment;
            $req->addComment();
            header('Location: index.php?action=post&id=' . $_POST['postID'] . '#redirCom');
        } else {
            header('Location: index.php?action=post&id=' . $_POST['postID']);
        }
    }
}



