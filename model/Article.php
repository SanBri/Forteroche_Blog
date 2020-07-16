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
        $res = $dbPosts->query("SELECT id, chapter, title, content, DATE_FORMAT(creation_date, 'le %d/%m/%Y à %H:%i') AS creation_date_fr, img FROM articles ORDER BY id DESC LIMIT $perPage OFFSET $offset");
        return $res;
    }

    public function countPosts() {
        $dbPosts = $this->dbConnect();
        $nbPosts = $dbPosts->query("SELECT COUNT(*) FROM articles")->fetch(\PDO::FETCH_NUM)[0];
        return $nbPosts;
    }

    public function getPost($postID) {
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare("SELECT id, chapter, title, content, DATE_FORMAT(creation_date, 'le %d/%m/%Y à %H:%i') AS creation_date_fr, img FROM articles WHERE  id = ? ");
        $req->execute(array($postID));
        $post = $req->fetch();
        return $post;
    } 

    public function getLastPost() {
        $dbPosts = $this->dbConnect();
        $res = $dbPosts->query("SELECT id, chapter, title, content, DATE_FORMAT(creation_date, 'le %d/%m/%Y à %H:%i') AS creation_date_fr, img FROM articles ORDER BY id DESC LIMIT 1");
        $lastPost = $res->fetch();
        return $lastPost;
    }

    public function getFirstPost() {
        $dbPosts = $this->dbConnect();
        $res = $dbPosts->query("SELECT id, chapter, title, content, DATE_FORMAT(creation_date, 'le %d/%m/%Y à %H:%i') AS creation_date_fr, img FROM articles ORDER BY id LIMIT 1");
        $firstPost = $res->fetch();
        return $firstPost;
    }

    public function getActualPost($postID) {
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->query("SELECT id, chapter, title, content, DATE_FORMAT(creation_date, 'le %d/%m/%Y à %H:%i') AS creation_date_fr, img FROM articles WHERE id = $postID");
        $actualPost = $req->fetch();
        return $actualPost;
    }

    public function addPost($image) {
        date_default_timezone_set('Europe/Paris');
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare( "INSERT INTO articles(id, title, content, creation_date, img) VALUES(?, ?, ?, ?, ?)" );
        $req->execute( array('', $_POST['title'], $_POST['content'], date('Y-m-d H:i:s'), $image) );
    }

    public function updatePost($postID, $image) {
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare("UPDATE articles SET title = ?, content = ?, img = ? WHERE id = $postID");
        $req->execute( array($_POST['title'], $_POST['content'], $image) );
        return $req;
    }

    public function deletePost($postID) {
        // INSERER MESSAGE DE CONFIRMATION
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare('DELETE FROM articles WHERE id = ?');
        $req->execute(array($postID));
    }

    public function ifNextPostExists($postID) {
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare("SELECT id FROM articles WHERE id > :id Order By id ASC LIMIT 1");
        $req->execute(array('id' => $postID));
        $req->setFetchMode(\PDO::FETCH_ASSOC);
        $nextPostID = $req->fetchColumn();  
        return $nextPostID;
    } 

    public function ifPreviousPostExists($postID) {
        $dbPosts = $this->dbConnect();
        $req = $dbPosts->prepare('SELECT id FROM articles WHERE id < :id Order By id DESC LIMIT 1');
        $req->execute(array('id' => $postID));
        $req->setFetchMode(\PDO::FETCH_ASSOC);
        $previousPostID = $req->fetchColumn();  
        return $previousPostID;
    }

}

?>