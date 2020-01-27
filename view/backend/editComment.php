<?php ob_start(); ?>

<h4 class="mb-3">Commentaire n°<?= $comment['id']; ?> de <strong><?= $comment['author']; ?><strong></strong></h4>
<form id="tinymceForm" action="index.php?action=updateComment&amp;idComment=<?= $comment['id']; ?>" method="post">
    <div class="col-md-12 mb-3">
        <label for="tinymceContent">Contenu du commentaire</label>
        <textarea id="tinymceContent" name="tinymceContent">
            <?= $comment['comment']; ?>
        </textarea>
        <div class="row">
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary mb-2">Modifier</button>
                <a href="index.php?action=createPost" class="btn btn-primary mb-2">Effacer</a>
            </div>
            <a class="nav-link" href="<?= $_SERVER['HTTP_REFERER']; ?>">
                Retour
            </a>
        </div>
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('template.php');
