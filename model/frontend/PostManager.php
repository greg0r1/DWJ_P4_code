<?php

class PostManager
{

    public function getPosts($limit, $start)
    {
        $db = $this->dbConnect();

        $sql_posts = ("SELECT *, DATE_FORMAT(creation_date, 'Message du : %d/%m/%Y à %Hh%i') AS formatted_date FROM posts  ORDER BY creation_date DESC LIMIT :limit OFFSET :start");
        $request_posts = $db->prepare($sql_posts) or die(print_r($db->errorInfo()));

        $request_posts->bindValue('limit', $limit, PDO::PARAM_INT);
        $request_posts->bindValue('start', $start, PDO::PARAM_INT);

        $request_posts->execute();


        return $request_posts;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT *, DATE_FORMAT(creation_date, 'Message du : %d/%m/%Y à %Hh%i') AS formatted_date FROM posts WHERE id = ?") or die(print_r($db->errorInfo()));;

        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function paging()
    {
        $db = $this->dbConnect();

        $sql_paging = "SELECT COUNT(*) AS number_total_posts FROM `posts`";
        $total_posts = $db->query($sql_paging);
        $req_total_posts = $total_posts->fetch();
        $number_total_posts = $req_total_posts['number_total_posts'];

        return $number_total_posts;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("INSERT INTO `comments`(`post_id`, `author`, `comment`, `comment_date`) VALUES (?,?,?,NOW())");
        $insertline = $comments->execute(array($postId, $author, $comment));

        return $insertline;
    }

    private function dbConnect()
    {
        try {
            $db = new PDO('mysql:host=localhost:8889;dbname=oc_forteroche; charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $db;
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }
}
