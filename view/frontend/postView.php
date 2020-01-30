<?php $title = 'Billet de ' . $post['author'];
?>

<?php ob_start(); ?>

<section id="article">
    <div class="container">
        <div class="news">
            <article>
                <div class="img-post">
                </div>
                <h1><?= htmlspecialchars($post['title']) ?></h1>
                <p><time datetime="<?= $post['creation_date']; ?>" pubdate="pubdate"><?= $post['formatted_date']; ?></time> de <?= $post['author']; ?></p>
                <p><?= strip_tags($post['content']); ?></p>
            </article>
        </div>

        <div id="commentaires">
            <h3>Commentaires </h3>
            <?php while ($comment = $comments->fetch()) : ?>
                <ul id="commentaires">
                    <li>
                        <article id="commentPost">
                            <p>
                                <span rel="author"><?= $comment['author'] ?></span>
                                <time pubdate datetime="<?= $comment['comment_date']; ?>"><?= $comment['comment_date_formatted'] ?></time>
                            </p>
                            <p><?= $comment['comment']; ?></p>
                        </article>
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
                    </li>
                </ul>
            <?php endwhile; ?>
            <?php
            $comments->closeCursor();
            ?>
            <form id="addComment" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="POST">
                <p><label for="author">Pseudo</label></p>
                <p><input type="text" name="author" id="author" value="<?= (isset($_SESSION['author'])) ? $_SESSION['author'] : ""; ?>"></p>
                <p><label for="comment">Message</label></p>
                <p><textarea name="comment" id="comment" cols="60" rows="2"></textarea></p>
                <p>
                    <input type="submit" class="btn btn-lg btn-primary" value="Envoyer">
                    <input type="reset" class="btn btn-lg btn-primary" value="Effacer">
                </p>
            </form>
        </div>

        <div id="retour_commentaires">
            <a href="index.php?action=listPosts" class="btn btn-secondary">Retour à la liste des billets</a>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php');
