<?php
require('controller/frontend.php');
require('controller/backend.php');

try {
    if (isset($_GET['action'])) {
        // Frontend
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                session_start();
                $postId = $_GET['id'];
                post($postId);
            } else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé', 1);
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    session_start();
                    $_SESSION['author'] = $_POST['author'];

                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception("Erreur : tous les champs ne sont pas remplis !", 1);
                }
            } else {
                throw new Exception("Erreur : aucun identifiant de billet envoyé", 1);
            }
        }
        // Backend
        elseif ($_GET['action'] == 'loginForm') {
            loginForm();
        } elseif ($_GET['action'] == 'loginCnx') {
            loginCnx();
        } elseif ($_GET['action'] == 'adminCnx') {
            adminCnx();
        } elseif ($_GET['action'] == 'reportedComment') {
            if (isset($_POST['reported'])) {
                $idComment = $_GET['commentId'];
                addReportComment($idComment);
                $postId = isset($_GET['postId']) ? $_GET['postId'] : listPosts();
                post($postId);
            } else {
                $postId = isset($_GET['postId']) ? $_GET['postId'] : listPosts();
                post($postId);
            }
        } elseif ($_GET['action'] == 'createPost') {
            createPost();
        } elseif ($_GET['action'] == 'addPost') {
            addPost();
        } elseif ($_GET['action'] == 'adminListPosts') {
            listPostsCRUD();
        } elseif ($_GET['action'] == 'editPost') {
            if (isset($_GET['id'])) {
                $postId = $_GET['id'];
                editPost($postId);
            } else {
                listPostsCRUD();
            }
        } elseif ($_GET['action'] == 'updatePost') {
            if (!empty($_POST['tinymceTitle']) || !empty($_POST['tinymceContent'])) {
                $idPost = $_GET['idPost'];
                $title = $_POST['tinymceTitle'];
                $content = $_POST['tinymceContent'];
                updatePost($idPost, $title, $content);
            } else {
                throw new Exception("Erreur de contenu. Les données du formulaire sont vides.", 1);
            }
        } elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $idPost = $_GET['id'];
                deletingPost($idPost);
            } else {
                throw new Exception("Erreur d\'identification du post", 1);
            }
        } elseif ($_GET['action'] == 'commentsList') {
            listCommentsCRUD();
        } elseif ($_GET['action'] == 'editComment') {
            if (isset($_GET['id'])) {
                $commentId = $_GET['id'];
                editComment($commentId);
            } else {
                listCommentsCRUD();
            }
        } elseif ($_GET['action'] == 'updateComment') {
            if (!empty($_POST['tinymceTitle']) || !empty($_POST['tinymceContent'])) {
                $idComment = $_GET['idComment'];
                $comment = $_POST['tinymceContent'];
                updateComment($idComment, $comment);
            } else {
                throw new Exception("Erreur de contenu. Les données du formulaire sont vides.", 1);
            }
        } elseif ($_GET['action'] == 'reportedCommentsList') {
            reportedCommentsListCRUD();
        } elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_GET['idComment']) && !empty($_GET['idComment'])) {
                $idComment = $_GET['idComment'];
                deletingComment($idComment);
            } else {
                throw new Exception("Erreur d'identification du commentaire", 1);
            }
        } else {
            listPosts();
        }
    } else {
        header('location:index.php?action=listPosts&page=1');
    }
} catch (Exception $e) {
    echo 'Erreur: ' . $e->getMessage();
}
