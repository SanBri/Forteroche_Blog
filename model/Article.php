<?php 

class Article {

    protected function dbConnect() {
        $dbArticle = new PDO('mysql:host=localhost;port=3308;dbname=blog','root', '', array(PDO::ATTR_ERRMODE => 
        PDO::ERRMODE_EXCEPTION));
        return $dbArticle;
    }

    public function getPosts() {
        $dbPosts = $this->dbConnect();
        $res = $dbPosts->query("SELECT id, title, content, DATE_FORMAT(creation_date, 'le %d/%m/%Y à %H:%i') AS creation_date_fr FROM articles ORDER BY id DESC");
        return $res;
    }

    public function getPost($postId) {
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, 'le %d/%m/%Y à %H:%i') AS creation_date_fr FROM articles WHERE  id = ? ");
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    } 

    public function addPost() {
        date_default_timezone_set('Europe/Paris');
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare( "INSERT INTO articles(id, title, content, creation_date) VALUES(?, ?, ?, ?)" );
        $req->execute( array('', $_POST['title'], $_POST['content'], date('Y-m-d H:i:s')) );
    }

    public function deletePost($postId) {
        // INSERER MESSAGE DE CONFIRMATION
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare('DELETE FROM articles WHERE id = ?');
        $req->execute(array($postId));
    }

}

?>