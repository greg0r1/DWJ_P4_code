<?php
$title = 'Forteroche';
?>
<?php ob_start(); ?>
<!-- Posts -->
<div class="container marketing">
    <div class="row">
        <?php
        while ($data = $posts->fetch()) {
            if (empty($data)) {
                echo 'Il n\'y a pas de billet à afficher!';
            } else {
        ?>
                <div class="col-lg-4">
                    <i id="account_circle" class="material-icons md-48">
                        short_text
                    </i>
                    <h2><?= strip_tags($data['title']) ?></h2>
                    <strong><?= $data['formatted_date'] . " de " . $data['author']; ?></strong>
                    <p><?= $data['content'] ?></p>
                    <p><a class="btn btn-secondary" href="index.php?action=post&amp;id=<?= $data['id']; ?>" role="button">Voir les commentaires &raquo;</a></p>
                </div>
        <?php
            }
        }
        $posts->closeCursor();
        ?>
    </div>
</div>
<!--end Posts -->

<!-- Paging -->
<div id=paging>
    <?php
    if ($page > $number_of_pages) {
    ?><div>
            <p style="font-size:2rem;margin:50px auto 5px">La page n'existe pas!</p>
            <p><a href="index.php">Retour</a></p>
        </div>
    <?php
    } else {
    ?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $number_of_pages; $i++) {
                    echo '<li><a href="index.php?action=listPosts&page=' . $i . '">' . $i .  '</a></li>';
                }
                ?>
            </ul>
        </nav>
    <?php
    }
    ?>
</div>
<!-- end paging -->

<?php $content = ob_get_clean(); ?>

<?php require('template.php');
