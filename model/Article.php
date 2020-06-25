<?php 

namespace Model;

class Article {

    protected function dbConnect() {
        $dbPosts = new \PDO('mysql:host=localhost;port=3308;dbname=blog','root', '', array(\PDO::ATTR_ERRMODE => 
        \PDO::ERRMODE_EXCEPTION));
        return $dbPosts;
    }

    public function getPosts($perPage, $offset) {
        $dbPosts = $this->dbConnect();
        $res = $dbPosts->query("SELECT id, title, content, DATE_FORMAT(creation_date, 'le %d/%m/%Y à %H:%i') AS creation_date_fr FROM articles ORDER BY id DESC LIMIT $perPage OFFSET $offset");
        return $res;
    }

    public function countPost() {
        $dbPosts = $this->dbConnect();
        $nbPosts = $dbPosts->query("SELECT COUNT(*) FROM articles")->fetch(\PDO::FETCH_NUM)[0];
        return $nbPosts;
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

    public function updatePost($postId) {
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare("UPDATE articles SET title = ?, content = ? WHERE id = $postId");
        $req->execute( array($_POST['title'], $_POST['content']) );
        return $req;
    }

    public function deletePost($postId) {
        // INSERER MESSAGE DE CONFIRMATION
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare('DELETE FROM articles WHERE id = ?');
        $req->execute(array($postId));
    }

}

?>