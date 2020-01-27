<?php

namespace OC\DWJ_P4\model\frontend;


require_once('Manager.php');

class PostManager extends Manager
{

    public function getPosts($limit, $start)
    {
        $db = $this->dbConnect();

        $sql_posts = ("SELECT *, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS formatted_date FROM oc_posts  ORDER BY creation_date DESC LIMIT :limit OFFSET :start");
        $request_posts = $db->prepare($sql_posts) or die(print_r($db->errorInfo()));

        $request_posts->bindValue('limit', $limit, \PDO::PARAM_INT);
        $request_posts->bindValue('start', $start, \PDO::PARAM_INT);

        $request_posts->execute();


        return $request_posts;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT *, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS formatted_date FROM oc_posts WHERE id = ?") or die(print_r($db->errorInfo()));;

        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
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

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("INSERT INTO `oc_comments`(`post_id`, `author`, `comment`, `comment_date`) VALUES (?,?,?,NOW())");
        $insertline = $comments->execute(array($postId, $author, $comment));

        return $insertline;
    }
}
