<?php

namespace OC\DWJ_P4\model\frontend;

require_once('Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("SELECT oc_comments.id, oc_comments.author, oc_comments.comment, oc_comments.comment_date, DATE_FORMAT(comment_date, ', le %d/%m/%Y à %Hh%imin') AS comment_date_formatted FROM `oc_comments` INNER JOIN `oc_posts` ON `post_id` = oc_posts.id WHERE oc_posts.id = ?");
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("INSERT INTO `oc_comments`(`post_id`, `author`, `comment`, `comment_date`) VALUES (?,?,?,NOW())");
        $insertline = $comments->execute(array($postId, $author, $comment));

        return $insertline;
    }

    public function reportComment($idComment)
    {
        $db = $this->dbConnect();
        $addReportComment = $db->prepare("UPDATE `oc_comments` SET `reported` = '1' WHERE `comments`.`id` = ?");
        $addReportComment->execute(array($idComment));

        if ($addReportComment == false) {
            throw new \Exception("Error: Le commentaire n'a pas pu être signalé", 1);
        } else {
            $alertMessReq = $db->prepare("SELECT `author` FROM `oc_comments` WHERE `id` = ?");
            $alertMessReq->execute(array($idComment));

            $alertMess = $alertMessReq->fetch();

            echo '<script>alert("Le commentaire de ' . $alertMess['author'] . ' a bien été signalé")</script>';
        }

        $alertMessReq->closeCursor();
        $addReportComment->closeCursor();
    }
}
