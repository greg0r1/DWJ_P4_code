<?php ob_start(); ?>

<h4 class="mb-3">Billet n°<?= $post['id']; ?> de <strong><?= $post['author']; ?><strong></strong></h4>
<form id="tinymceForm" action="index.php?action=updatePost&amp;idPost=<?= $post['id']; ?>" method="post">
    <div class="col-md-12 mb-3">
        <label for="tinymceTitle">Titre du billet</label>
        <input type="text" class="form-control" name="tinymceTitle" id="tinymceTitle" placeholder="" value="<?= $post['title']; ?>" required>
        <div class="invalid-feedback">
            Veuillez saisir un titre pour ce billet.
        </div>
        <label for="tinymceContent">Contenu du billet</label>
        <textarea id="tinymceContent" name="tinymceContent">
            <?= $post['content']; ?>
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
