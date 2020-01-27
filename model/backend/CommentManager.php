<?php

namespace OC\DWJ_P4\model\backend;

require_once('Manager.php');

class CommentManager extends Manager
{
    public function getCommentsCRUD($limit, $start)
    {
        $db = $this->dbConnect();

        $sql_comments = ("SELECT *, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS comment_date_format FROM oc_comments ORDER BY comment_date DESC LIMIT :limit OFFSET :start");
        $request_comments = $db->prepare($sql_comments) or die(print_r($db->errorInfo()));

        $request_comments->bindValue('limit', $limit, \PDO::PARAM_INT);
        $request_comments->bindValue('start', $start, \PDO::PARAM_INT);

        $request_comments->execute();


        return $request_comments;
    }

    public function modifyCommentCRUD($commentId)
    {
        $db = $this->dbConnect();

        $request_comment = $db->prepare("SELECT * FROM `oc_comments` WHERE id = ?") or die(print_r($db->errorInfo()));

        $request_comment->execute(array($commentId));
        $comment = $request_comment->fetch();
        return $comment;
        $request_comment->closeCursor();
    }

    public function updatingComment($idComment, $comment)
    {
        $db = $this->dbConnect();
        $request_post = $db->prepare("UPDATE `oc_comments` SET `comment`= :comment, `last_modification`= NOW() WHERE id = :idComment");
        $request_post->execute(array(
            'comment' => $comment,
            'idComment' => $idComment
        ));
        if ($request_post == false) {
            throw new \Exception("Erreur: Le commentaire n'a pas été modifié.", 1);
        }
        $request_post->closeCursor();
    }

    public function paging()
    {
        $db = $this->dbConnect();

        $sql_paging = "SELECT COUNT(*) AS number_total_comments FROM `oc_comments`";
        $total_comments = $db->query($sql_paging);
        $req_total_comments = $total_comments->fetch();
        $number_total_comments = $req_total_comments['number_total_comments'];

        return $number_total_comments;
    }

    public function pagingReportedCommentsList()
    {
        $db = $this->dbConnect();

        $sql_paging = "SELECT COUNT(*) AS number_total_comments FROM `oc_comments` WHERE `reported` = 1";
        $total_comments_reported = $db->query($sql_paging);
        $req_total_comments_reported = $total_comments_reported->fetch();
        $number_total_comments_reported = $req_total_comments_reported['number_total_comments'];

        return $number_total_comments_reported;
    }

    public function getReportedCommentsCRUD($limit, $start)
    {
        $db = $this->dbConnect();

        $sql_comments = ("SELECT *, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS comment_date_format FROM `oc_comments` WHERE `reported` = 1 ORDER BY `oc_comments`.`comment_date` DESC LIMIT :limit OFFSET :start");
        $request_comments = $db->prepare($sql_comments) or die(print_r($db->errorInfo()));

        $request_comments->bindValue('limit', $limit, \PDO::PARAM_INT);
        $request_comments->bindValue('start', $start, \PDO::PARAM_INT);

        $request_comments->execute();


        return $request_comments;
    }

    public function deleteComment($idComment)
    {
        $db = $this->dbConnect();
        $request_delete_comment = $db->prepare("DELETE FROM `oc_comments` WHERE id = :idComment");
        $request_delete_comment->execute(array(
            'idComment' => $idComment
        ));

        return $request_delete_comment;
    }
}
