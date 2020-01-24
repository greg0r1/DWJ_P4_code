<?php

class CommentManager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("SELECT comments.id, comments.author, comments.comment, comments.comment_date, DATE_FORMAT(comment_date, ', le %d/%m/%Y à %Hh%imin') AS comment_date_formatted FROM `comments` INNER JOIN `posts` ON `post_id` = posts.id WHERE posts.id = ?");
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("INSERT INTO `comments`(`post_id`, `author`, `comment`, `comment_date`) VALUES (?,?,?,NOW())");
        $insertline = $comments->execute(array($postId, $author, $comment));

        return $insertline;
    }

    public function reportComment($idComment)
    {
        $db = $this->dbConnect();
        $addReportComment = $db->prepare("UPDATE `comments` SET `reported` = '1' WHERE `comments`.`id` = ?");
        $addReportComment->execute(array($idComment));

        if ($addReportComment == false) {
            throw new Exception("Error: Le commentaire n'a pas pu être signalé", 1);
        } else {
            $alertMessReq = $db->prepare("SELECT `author` FROM `comments` WHERE `id` = ?");
            $alertMessReq->execute(array($idComment));

            $alertMess = $alertMessReq->fetch();

            echo '<script>alert("Le commentaire de ' . $alertMess['author'] . ' a bien été signalé")</script>';
        }

        $alertMessReq->closeCursor();
        $addReportComment->closeCursor();
    }

    private function dbConnect()
    {
        try {
            $db = new PDO('mysql:host=localhost:8889;dbname=oc_forteroche; charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $db;
        } catch (Exception $e) {
            die('Erreur' . $e->getMessage());
        }
    }
}
