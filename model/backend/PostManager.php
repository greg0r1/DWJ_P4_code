<?php

namespace OC\DWJ_P4\model\backend;

require_once('Manager.php');

class PostManager extends Manager
{

    public function addNewPost()
    {
        $db = $this->dbConnect();
        $sql = "INSERT INTO `oc_posts`(`title`, `content`, `author`, `creation_date`) VALUES (:title,:content,:author,NOW())";
        $newPost = $db->prepare($sql);
        $newPost->execute(array(
            'title' => $_POST['tinymceTitle'],
            'content' => $_POST['tinymceContent'],
            'author' => $_COOKIE['nameAdminConnected']
        ));
        $newPost->closeCursor();
    }

    public function getPostsCRUD($limit, $start)
    {
        $db = $this->dbConnect();

        $sql_posts = ("SELECT *, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS formatted_date, DATE_FORMAT(last_modification, '%d/%m/%Y à %Hh%i') AS last_modification_format FROM oc_posts  ORDER BY creation_date DESC LIMIT :limit OFFSET :start");
        $request_posts = $db->prepare($sql_posts) or die(print_r($db->errorInfo()));
        $request_posts->bindValue('limit', $limit, \PDO::PARAM_INT);

        $request_posts->bindValue('start', $start, \PDO::PARAM_INT);

        $request_posts->execute();


        return $request_posts;
    }

    public function paging()
    {
        $db = $this->dbConnect();

        $sql_paging = "SELECT COUNT(*) AS number_total_posts FROM `oc_posts`";
        $total_posts = $db->query($sql_paging);
        $req_total_posts = $total_posts->fetch();
        $number_total_posts = $req_total_posts['number_total_posts'];

        return $number_total_posts;
    }

    public function modifyPostCRUD($postId)
    {
        $db = $this->dbConnect();

        $request_post = $db->prepare("SELECT * FROM `oc_posts` WHERE id = ?") or die(print_r($db->errorInfo()));

        $request_post->execute(array($postId));
        $post = $request_post->fetch();
        return $post;
        $request_post->closeCursor();
    }

    public function updatingPost($idPost, $title, $content)
    {
        $db = $this->dbConnect();
        $request_post = $db->prepare("UPDATE `oc_posts` SET `title`= :title,`content`= :content, `last_modification`= NOW() WHERE id = :idPost");
        $request_post->execute(array(
            'title' => $title,
            'content' => $content,
            'idPost' => $idPost
        ));
        if ($request_post == false) {
            throw new \Exception("Erreur: Le billet n'a pas été modifié.", 1);
        }
        $request_post->closeCursor();
    }

    public function deletePost($idPost)
    {
        $db = $this->dbConnect();
        $request_post = $db->prepare("DELETE FROM `oc_posts` WHERE id = :idPost");
        $request_post->execute(array(
            'idPost' => $idPost
        ));
        if ($request_post == false) {
            throw new \Exception("Erreur: Le billet n'a pas été supprimé.", 1);
        }
        $request_post->closeCursor();
    }
}
