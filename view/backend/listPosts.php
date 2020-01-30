<?php ob_start(); ?>

<?php $titleCurrentPage = 'Gestionnaire de Billets'; ?>

<div>
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Posts Manager
                    </h2>
                </div>
                <div class="col-sm-6">
                    <a href="index.php?action=createPost" class="btn btn-success">
                        <i class="material-icons"></i>
                        <span>Ajouter un billet</span>
                    </a>
                </div>
            </div>
        </div>
        <table id="listPostsCRUD" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Contenu du billet</th>
                    <th>Auteur</th>
                    <th>Date de création</th>
                    <th>Date de modification</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number0fElements = 0;

                while ($data = $posts->fetch()) {
                    if (empty($data)) {
                        echo 'Il n\'y a pas de billet à afficher!';
                    } else {
                        $number0fElements++;
                ?>
                        <tr>
                            <td><?= $data['id'] ?></td>
                            <td><?= $data['title'] ?></td>
                            <td><?= $data['content']; ?></td>
                            <td><?= $data['author']; ?></td>
                            <td><?= $data['formatted_date']; ?></td>
                            <td><?= $data['last_modification_format']; ?></td>
                            <td>
                                <a href="index.php?action=editPost&amp;id=<?= $data['id']; ?>" class="edit" title="Modifier">
                                    <i class="material-icons"></i>
                                </a>
                                <a href="index.php?action=deletePost&amp;id=<?= $data['id']; ?>" class="delete" title="Supprimer" onclick="return deleteDialog()">
                                    <i class="material-icons"></i>
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                }
                $posts->closeCursor();
                ?>

            </tbody>
        </table>
        <div class="clearfix">
            <div class="hint-text">Affichage de
                <b><?= $number0fElements ?></b>
                entrées sur
                <b><?= $number_total_posts; ?></b>
            </div>
            <ul class="pagination">
                <li class="page-item">
                    <?php if ($page > 1) : ?>
                        <a href="index.php?action=adminListPosts&page=<?= $page - 1 ?>" class="page-link">Précédent</a>
                    <?php endif; ?>
                </li>

                <?php
                for ($i = 1; $i <= $number_of_pages; $i++) {
                ?>
                    <li class="page-item">
                        <a href="index.php?action=adminListPosts&page=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                    </li>
                <?php
                };
                ?>
                <li class="page-item">
                    <?php if ($page < $number_of_pages) : ?>
                        <a href="index.php?action=adminListPosts&page=<?= $page + 1 ?>" class="page-link">Suivant</a>
                    <?php endif; ?>
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
