<body>
    <header>
        <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0">
            <a class="navbar-brand col-sm-2 col-md-3 mr-0" href="#">My Blog</a>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="index.php?action=loginForm">Se déconnecter</a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-2 col-md-3 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?action=adminCnx">
                                <span data-feather="home"></span>
                                Accueil <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=createPost">
                                <span data-feather="file-text"></span>
                                Ecrire un billet
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file"></span>
                                Dernier billet
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Tous les billets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Dernier commentaire
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="layers"></span>
                                Tous les commentaires
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Rapports</span>
                        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather=""></span>
                                Billets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather=""></span>
                                Commentaires
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather=""></span>
                                Réseaux sociaux
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
                <div>
                    <h2>Bienvenue dans votre espace d'administration <strong><?= $_COOKIE['nameAdminConnected'] ?></strong></h2>
                    <p> Retrouvez tous les services utiles pour l'administration de votre blog.
                    </p>
                </div>