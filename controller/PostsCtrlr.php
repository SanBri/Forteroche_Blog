<?php

namespace Controller;

use \Model\Article;
use \Model\Comment;

class PostsCtrlr {

    public function listPosts() {
        if( isset($_GET['page']) && $_GET['page'] > 1 ){
            $currentPage = (int)$_GET['page'];
        } else {
            $currentPage = 1; 
        } 
        $perPage = 3;
        $offset = $perPage * ($currentPage - 1);
        $req = new Article;
        $posts = $req->getPosts($perPage, $offset);
        $nbPosts = $req->countPosts();
        $lastPost = $req->getLastPost();
        $pages = ceil($nbPosts / $perPage); //ceil() arrondit au supérieur
        if ( isset($_GET['page']) && $_GET['page'] > $pages) {
            $currentPage = $pages;
        }
        require('view/frontend/postsView.php');
    }

    public function showPost($postID) {
        $req = new Article;
        $post = $req->getPost($postID);
        $comReq = new CommentsCtrlr;
        $comments = $comReq->getComments($postID);
        $lastPost = $req->getLastPost();
        $firstPost = $req->getFirstPost();   
        setcookie('actualChapter', $postID, time()+365*24*3600, null, null, false, true);
        if ($post) {
            require('view/frontend/postView.php');
        } else {
            require('view/frontend/unknownPostView.php');
        }
    }

    public function showHomePage() {
        $req = new Article;
        if (isset($_COOKIE['actualChapter'])) {
            $actualPost = $req->getActualPost($_COOKIE['actualChapter']);
        }
        $lastPost = $req->getLastPost();
        $firstPost = $req->getFirstPost();
        $nbPosts = $req->countPosts();
        require('view/frontend/homeView.php');
    }

    public function createPost() {
            $req = new Article;
            $lastPost = $req->getLastPost();
            require('view/backend/addPostView.php');

    }

    public function newPost() {
        session_start();
        if ( isset($_SESSION['admin']) && $_SESSION['token'] === $_GET['token'] ) {
            if ( !empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['chapter'])) { 
                if (!preg_match('/^[0-9]+$/', $_POST['chapter']) ) {
                    echo "Veuillez renseigner un numéro de chapitre valide !";
                } 
                if ($_FILES['image']['size'] != 0) {
                    $image = $this->imageCheck();
                } else {
                    $image = null;
                }
                $req = new Article;
                $req->addPost($image);
                header('Location: index.php?action=administration');
            } else {
                echo '<p>Veuillez renseigner les champs !</p>';
            }
        } else {
            header('Location: index.php?action=forbidden');
        }
    }

    public function ImageCheck() {
        if ($_FILES['image']['size'] != 0) {
            $imgPath = 'public/images/posts_img/';
            $image = basename($_FILES['image']['name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['image']['name'],'.');
            $maxSize = 200000;
            $size = filesize($_FILES['image']['tmp_name']);
            if (!in_array($extension, $extensions)) {
                exit("Le format du fichier n'est pas valide ! (Les formats acceptés sont : .png, .gif, .jpg et .jpeg)" );
            } else {
                if ($size>$maxSize) { 
                    exit("La taille du fichier est trop élevée ! (Taille maximum : 200Ko) ");
                } else {
                    $image = strtr($image, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $image = preg_replace("/([^.a-z0-9]+)/i", '-', $image);
                    $renamedImage = time() . $image; // Pour éviter un conflit en cas d'upload du même nom
                    if ( move_uploaded_file($_FILES['image']['tmp_name'], $imgPath . $renamedImage) ) {
                        return $renamedImage;
                    } 
                }
            }
        } else {
            echo 'Veuillez choisir une image !';
        }
    }

    public function deleteImagePost($image, $postID) {
        $req = new Article;
        $req->deleteImage($postID);
        unlink($image); // Pour supprimer le fichier image dans le répertoire "/public/images"
    }

    public function showPosttoEdit() {
        session_start();
        if ( isset($_SESSION['admin']) && $_SESSION['token'] === $_GET['token'] ) {
            $req = new Article;
            $post = $req->getPost($_GET['id']);
            if ($post) {
                require('view/backend/editPostView.php');
            } else {
                require('view/frontend/unknownPostView.php');
            } 
        } else {
            header('Location: index.php?action=forbidden');
        }
    }

    public function editPost($postID, $oldImage) {
        session_start();
        if ( isset($_SESSION['admin']) && $_SESSION['token'] === $_GET['token'] ) {
            if ( !empty($_POST['title']) && !empty($_POST['content']) ) { 
                $req = new Article;
                if ($_FILES['image']['size'] != 0) { 
                    $image = $this->imageCheck();
                    if ($oldImage != null) {
                        unlink($oldImage); // Pour supprimer le fichier image dans le répertoire "/public/images"
                    }
                } else {
                    if ($oldImage != "public/images/posts_img/") {
                        $sameImage = strrchr($oldImage, '/');
                        $image = $sameImage;
                    }
                }
                if (isset($_POST['deletedImageCheck'])) { // Si l'img a été supprimée depuis <icn>
                    unlink($oldImage); 
                    if (($_FILES['image']['size'] === 0)) { // Si aucune image pour remplacer
                        $image = null;
                    }
                }
                $req->updatePost($postID, $image);
                header('Location: index.php?action=post&id=' . $_POST['postID']); 
            } 
        } else {
            header('Location: index.php?action=forbidden');
        }
    }

    public function deletePost($postId, $image) {
        session_start();
        if ( isset($_SESSION['admin']) && $_SESSION['token'] === $_GET['token'] ) {
            $req = new Article;
            $req->deletePost($postId);
            $reqCom = new Comment;
            $reqCom->deleteAllComments($postId);
            if ( $image != "public/images/posts_img/" ) {
                unlink($image); // Pour supprimer le fichier image dans le répertoire "/public/images"
            }
            header('Location: index.php?action=administration'); 
        } else {
            header('Location: index.php?action=forbidden');
        }
    }

    public function nextPost($postID) {
        $req = new Article; 
        $nextPost = $req->ifNextPostExists($postID);
        header('Location: index.php?action=post&id=' . $nextPost);
        $this->showPost($nextPost);
    }

    public function previousPost($postID) {
        $req = new Article; 
        $previousPost = $req->ifPreviousPostExists($postID);
        if ($previousPost) {
            header('Location: index.php?action=post&id=' . $previousPost);
            $this->showPost($previousPost);
        } else {
            header('Location: index.php?action=uknokwn');
        }

    }
    
}
