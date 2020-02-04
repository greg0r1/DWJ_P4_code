<?php
require('controller/frontend.php');
require('controller/backend.php');

try {
    if (isset($_GET['action'])) {
        // Frontend
        if (strip_tags($_GET['action']) == 'listPosts') {
            listPosts();
        } elseif (strip_tags($_GET['action']) == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                session_start();
                $postId = strip_tags($_GET['id']);
                post($postId);
            } else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé', 1);
            }
        } elseif (strip_tags($_GET['action']) == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    session_start();
                    $_SESSION['author'] = strip_tags($_POST['author']);

                    addComment(strip_tags($_GET['id']), strip_tags($_POST['author']), strip_tags($_POST['comment']));
                } else {
                    throw new Exception("Erreur : tous les champs ne sont pas remplis !", 1);
                }
            } else {
                throw new Exception("Erreur : aucun identifiant de billet envoyé", 1);
            }
        }
        // Backend
        elseif (strip_tags($_GET['action']) == 'loginForm') {
            loginForm();
        } elseif (strip_tags($_GET['action']) == 'loginCnx') {
            loginCnx();
        } elseif (strip_tags($_GET['action']) == 'adminCnx') {
            adminCnx();
        } elseif (strip_tags($_GET['action']) == 'reportedComment') {
            if (isset($_POST['reported'])) {
                $idComment = strip_tags($_GET['commentId']);
                addReportComment($idComment);
                $postId = isset($_GET['postId']) ? $_GET['postId'] : listPosts();
                post($postId);
            } else {
                $postId = isset($_GET['postId']) ? $_GET['postId'] : listPosts();
                post($postId);
            }
        } elseif (strip_tags($_GET['action']) == 'createPost') {
            createPost();
        } elseif (strip_tags($_GET['action']) == 'addPost') {
            addPost();
        } elseif (strip_tags($_GET['action']) == 'adminListPosts') {
            listPostsCRUD();
        } elseif (strip_tags($_GET['action']) == 'editPost') {
            if (isset($_GET['id'])) {
                $postId = $_GET['id'];
                editPost($postId);
            } else {
                listPostsCRUD();
            }
        } elseif (strip_tags($_GET['action']) == 'updatePost') {
            if (!empty($_POST['tinymceTitle']) || !empty($_POST['tinymceContent'])) {
                $idPost = strip_tags($_GET['idPost']);
                $title = $_POST['tinymceTitle'];
                $content = $_POST['tinymceContent'];
                updatePost($idPost, $title, $content);
            } else {
                throw new Exception("Erreur de contenu. Les données du formulaire sont vides.", 1);
            }
        } elseif (strip_tags($_GET['action']) == 'deletePost') {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $idPost = $_GET['id'];
                deletingPost($idPost);
            } else {
                throw new Exception("Erreur d\'identification du post", 1);
            }
        } elseif (strip_tags($_GET['action']) == 'commentsList') {
            listCommentsCRUD();
        } elseif (html_entity_decode($_GET['action']) == 'editComment') {
            if (isset($_GET['id'])) {
                $commentId = strip_tags($_GET['id']);
                editComment($commentId);
            } else {
                listCommentsCRUD();
            }
        } elseif (strip_tags($_GET['action']) == 'updateComment') {
            if (!empty($_POST['tinymceTitle']) || !empty($_POST['tinymceContent'])) {
                $idComment = $_GET['idComment'];
                $comment = $_POST['tinymceContent'];
                updateComment($idComment, $comment);
            } else {
                throw new Exception("Erreur de contenu. Les données du formulaire sont vides.", 1);
            }
        } elseif (strip_tags($_GET['action']) == 'reportedCommentsList') {
            reportedCommentsListCRUD();
        } elseif (strip_tags($_GET['action']) == 'deleteComment') {
            if (isset($_GET['idComment']) || !empty($_GET['idComment'])) {
                $idComment = strip_tags($_GET['idComment']);
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
