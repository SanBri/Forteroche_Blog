<?php 

class Article {

    protected function dbConnect() {
        $dbArticle = new PDO('mysql:host=localhost;port=3308;dbname=blog','root', '', array(PDO::ATTR_ERRMODE => 
        PDO::ERRMODE_EXCEPTION));
        return $dbArticle;
    }

    public function getPosts() {
        $dbPosts = $this->dbConnect();
        $res = $dbPosts->query('SELECT * FROM articles');
        return $res;
    }

    public function getPost($postId) {
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare('SELECT id, title, content FROM articles WHERE  id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    } 

}

?>