<?php
$title = 'Accueil - Tableau de bord';
?>
<?php ob_start(); ?>

<div id="CRUD-billets">
    <h3>CRUD Billets</h3>
    <div class="row mb-3">
        <div class="col-4 themed-grid-col">
            <a href="index.php?action=createPost">
                <i class="material-icons">note_add</i>
                <p>Ecrire un billet</p>
            </a>
        </div>
        <div class="col-4 themed-grid-col"><i class="material-icons">create</i>
            <p>Modifier un billet</p>
        </div>
        <div class="col-4 themed-grid-col"><i class="material-icons">delete_sweep</i>
            <p>Supprimer un billet</p>
        </div>
    </div>
</div>

<div id="CRUD-commentaires">
    <h3>CRUD Commentaires</h3>
    <div class="row mb-3">
        <div class="col-4 themed-grid-col">
            <i class="material-icons">note_add</i>
            <p>Les commentaires signalés</p>
        </div>
        <div class="col-4 themed-grid-col"><i class="material-icons">create</i>
            <p>Modifier un commentaires</p>
        </div>
        <div class="col-4 themed-grid-col"><i class="material-icons">delete_sweep</i>
            <p>Supprimer un commentaires</p>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php');
