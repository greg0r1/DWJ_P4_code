<?php ob_start(); ?>

<?php $titleCurrentPage = 'Commentaires signalés'; ?>

<div>
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Reported Comments Manager
                    </h2>
                </div>
            </div>
        </div>
        <table id="listPostsCRUD" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Identifiant du billet</th>
                    <th>Auteur</th>
                    <th>Contenu du commentaire</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data_comments = $comments->fetch()) {
                    if (empty($data_comments)) {
                        echo 'Il n\'y a pas de commentaire à afficher!';
                    } else {
                ?>
                        <tr>
                            <td><?= $data_comments['id'] ?></td>
                            <td><a href="index.php?action=editPost&amp;id=<?= $data_comments['id']; ?>"><?= $data_comments['post_id'] ?></a></td>
                            <td><?= $data_comments['author'] ?></td>
                            <td><?= $data_comments['comment'] ?></td>
                            <td><?= $data_comments['comment_date_format'] ?></td>
                            <td>
                                <a href="index.php?action=editPost&amp;id=<?= $data_comments['id']; ?>" class="edit" title="Modifier">
                                    <i class="material-icons"></i>
                                </a>
                                <a href="index.php?action=deletePost&amp;id=<?= $data_comments['id']; ?>" class="delete" title="Supprimer" onclick="return deleteDialog()">
                                    <i class="material-icons"></i>
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                }
                $comments->closeCursor();
                ?>

            </tbody>
        </table>
        <div class="clearfix">
            <div class="hint-text">Affichage de
                <b><?= $limit; ?></b>
                entrées sur
                <b><?= $number_total_posts; ?></b>
            </div>
            <ul class="pagination">
                <li class="page-item disabled">
                    <a href="index.php?action=reportedCommentsList&amp;page=<?= $i; ?>">Previous</a>
                </li>

                <?php
                for ($i = 1; $i <= $number_of_pages; $i++) {
                ?>
                    <li class="page-item">
                        <a href="index.php?action=reportedCommentsList&amp;page=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                    </li>
                <?php
                };
                ?>
                <li class="page-item">
                    <a href="index.php?action=reportedCommentsList&amp;page=<?= $i++; ?>" class="page-link">Next</a>
                </li>
            </ul>
        </div>
    </div>
    <a class="nav-link" href="<?= $_SERVER['HTTP_REFERER']; ?>">
        Retour
    </a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php');
