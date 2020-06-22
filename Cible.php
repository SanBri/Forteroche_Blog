<?php 

require_once('controller/commentsCtrlr.php');
require_once('controller/viewsCtrlr.php');


class Cible  {

    public function commentRedirection() {
        $commentAdded = new commentCtrlr;
        $commentAdded->checkComment();
    }

}

$cibleComment = new Cible;
$cibleComment->commentRedirection();