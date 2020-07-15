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
        $perPage = 2;
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
        if ($post) {
            require('view/frontend/postView.php');
        } else {
            require('view/frontend/unknownPostView.php');
        }
    }

    public function showHomePage() {
        $req = new Article;
        $lastPost = $req->getLastPost();
        $firstPost = $req->getFirstPost();
        $nbPosts = $req->countPosts();
        require('view/frontend/homeView.php');
    }

    public function newPost() {
        session_start();
        if ( isset($_SESSION['admin']) && $_SESSION['token'] === $_GET['token'] ) {
            if ( !empty($_POST['title']) && !empty($_POST['content']) ) { 
                $image = $this->imageCheck();
                if ( $image ) {
                    $req = new Article;
                    $req->addPost($image);
                    header('Location: index.php?action=administration');
                }
            } else {
                echo '<p>Veuillez renseigner les champs !</p>
                <p><a href="index.php?action=createPost"><input type="button" value="Retour" class="bttn"></a></p>';
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
            $maxSize = 100000;
            $size = filesize($_FILES['image']['tmp_name']);
            if (!in_array($extension, $extensions)) {
                var_dump($_FILES['image']);
                echo "Le format du fichier n'est pas valide ! (Les formats acceptés sont : .png, .gif, .jpg et .jpeg)";
            } else {
                if ($size>$maxSize) { 
                echo "La taille du fichier est trop élevée ! (Taille maximum : 100Ko)";
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

    public function showPosttoEdit() {
            $req = new Article;
            $post = $req->getPost($_GET['id']);
            if ($post) {
                require('view/backend/editPostView.php');
            } else {
                require('view/frontend/unknownPostView.php');
            }
    }

    public function editPost($postId, $oldImage) {
        session_start();
        if ( isset($_SESSION['admin']) && $_SESSION['token'] === $_GET['token'] ) {
            if ( !empty($_POST['title']) && !empty($_POST['content']) ) { 
                $image = $this->ImageCheck();
                $req = new Article;
                if ($image) {
                    $req->updatePost($postId, $image);
                    unlink($oldImage); // Pour supprimer le fichier image dans le répertoire "/public/images"
                    header('Location: index.php?action=post&id=' . $_POST['postID']);
                }
            } else {
                echo '<p>Veuillez renseigner les champs !</p>
                <p><a href="index.php?action=createPost"><input type="button" value="Retour" class="bttn"></a></p>';
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
            unlink($image); // Pour supprimer le fichier image dans le répertoire "/public/images"
            echo ("<p>Article supprimé</p> <p><a href='Index.php?action=administration'>Retour à l'administration</a></p> "); 
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
