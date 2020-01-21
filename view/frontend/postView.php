<?php $title = 'Billet de ' . $post['author'] ?>

<?php ob_start(); ?>

<div id="commentaires_billet" class="container">

    <div class="news">
        <h3><?= htmlspecialchars($post['title']) ?></h3>
        <em><?= $post['formatted_date'] . " de " . $post['author']; ?></em>
        <p><?= htmlspecialchars($post['content']); ?></p>
    </div>

    <div id="commentaires">
        <h4>Commentaires </h4>
        <?php while ($comment = $comments->fetch()) : ?>
            <ul id="commentaires">
                <li><strong><?= $comment['author'] ?></strong><em><?= $comment['comment_date_formatted'] ?></em>
                    <p><?= $comment['comment']; ?></p>
                    <p>
                        <form id="reportedCommentForm" action="index.php?action=reportedComment&amp;commentId=<?= $comment['id'] ?>&amp;postId=<?= $post['id'] ?>" method="post">
                            <div class="col-auto">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="reported" id="autoSizingCheck">
                                    <label class="form-check-label" for="autoSizingCheck">
                                        Signaler ce commentaire
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Envoyer</button>
                            </div>
                        </form>
                    </p>
                </li>
            </ul>
        <?php endwhile; ?>
        <?php
        $comments->closeCursor();
        ?>
    </div>

    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="POST">
        <p><label for="author">Pseudo</label></p>
        <p><input type="text" name="author" id="author" value="<?= $_COOKIE['author']; ?>"></p>
        <p><label for="comment">Message</label></p>
        <p><textarea name="comment" id="comment" cols="50" rows="4"></textarea></p>
        <p>
            <input type="submit" class="btn btn-lg btn-primary" value="Envoyer">
            <input type="reset" class="btn btn-lg btn-primary" value="Effacer">
        </p>
    </form>
    <div id="retour_commentaires">
        <a href="index.php?action=listPosts" class="btn btn-secondary">Retour à la liste des billets</a>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php');
