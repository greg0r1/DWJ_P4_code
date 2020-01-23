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
                        <span>Ajouter un billet</span></a>
                    <a href="#deleteEmployeeModal" class="btn btn-danger">
                        <i class="material-icons"></i>
                        <span>Supprimer</span></a>
                </div>
            </div>
        </div>
        <table id="listPostsCRUD" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="selectAll">
                            <label for="selectAll"></label>
                        </span>
                    </th>
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
                while ($data = $posts->fetch()) {
                    if (empty($data)) {
                        echo 'Il n\'y a pas de billet à afficher!';
                    } else {
                ?>
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox<?= $data['id'] ?>" name="idPost-<?= $data['id'] ?>" value="1">
                                    <label for="checkbox<?= $data['id'] ?>"></label>
                                </span>
                            </td>
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
                <b><?= $limit; ?></b>
                entrées sur
                <b><?= $number_total_posts; ?></b>
            </div>

            <?php
            if ($page > $number_of_pages) {
            ?><div>
                    <p style="font-size:2rem;margin:50px auto 5px">La page n'existe pas!</p>
                    <p><a href="index.php">Retour</a></p>
                </div>
            <?php
            } else {
            ?>

                <ul class="pagination">
                    <li class="page-item disabled">
                        <a href="#">Previous</a>
                    </li>

                    <?php
                    for ($i = 1; $i <= $number_of_pages; $i++) {
                    ?>
                        <li class="page-item">
                            <a href="index.php?action=adminListPosts&amp;page=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                        </li>
                    <?php
                    };
                    ?>
                    <li class="page-item">
                        <a href="#" class="page-link">Next</a>
                    </li>
                </ul>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php');
