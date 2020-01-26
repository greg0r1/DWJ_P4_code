<?php ob_start(); ?>

<div class="container">
    <h3>Le commentaire <strong><?= $idComment; ?></strong> a bien été modifié.</h3>
    <a class="nav-link" href="index.php?action=commentsList">
        Retour à la liste des commentaires
    </a>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php');
