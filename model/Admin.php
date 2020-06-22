<?php 

namespace Model;

class Admin extends Article {

    public function register($login, $password) {
        $dbAdmin = parent::dbConnect();
        $req = $dbAdmin->prepare( "INSERT INTO administration(id, pseudo, pass) VALUES(?, ?, ?)" );
        $req->execute( array('', $login, $password) );
    }

    public function checkAccount($pseudo) {
        $dbAdmin = parent::dbConnect();
        $req = $dbAdmin->prepare("SELECT id, pseudo, pass FROM administration WHERE pseudo = ?");
        $req->execute(array($pseudo));
        $res = $req->fetch();    
        return $res;
    }
}