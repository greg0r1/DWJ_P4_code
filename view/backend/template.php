<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $titleCurrentPage ?></title>
    <?php include('includes/links.php'); ?>
</head>

<?php include('includes/header.php'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-12 pb-12 mb-13">
    <h1 class="h1"><?= $titleCurrentPage ?></p>
</div>

<?= $content ?>

</main>
</div>
</div>

<?php include('includes/footer.php'); ?>