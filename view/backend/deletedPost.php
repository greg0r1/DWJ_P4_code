<?php ob_start(); ?>

<div class="container">
    <h3>Le billet <strong><?= $idPost; ?></strong> a bien été supprimé.</h3>
    <a class="nav-link" href="index.php?action=adminListPosts">
        Retour à la liste des billets
    </a>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php');
