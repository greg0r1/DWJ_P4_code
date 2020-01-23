<?php ob_start(); ?>

<?php $titleCurrentPage = 'Rédaction d\'un billet'; ?>

<form id="tinymceForm" action="index.php?action=addPost" method="post">
  <div class="col-md-12 mb-3">
    <label for="tinymceTitle">Titre du billet</label>
    <input type="text" class="form-control" name="tinymceTitle" id="tinymceTitle" placeholder="" value="" required>
    <div class="invalid-feedback">
      Veuillez saisir un titre pour ce billet.
    </div>
    <label for="tinymceContent">Contenu du billet</label>
    <textarea id="tinymceContent" name="tinymceContent"></textarea>
    <div class="row">
      <div class="col-md-12 mb-3">
        <button type="submit" class="btn btn-primary mb-2">Envoyer</button>
        <button type="reset" class="btn btn-primary mb-2">Effacer</button>
      </div>
      <a class="nav-link" href="<?= $_SERVER['HTTP_REFERER']; ?>">
        Retour
      </a>
    </div>
</form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php');
