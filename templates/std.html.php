<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>P5 - blog OCR</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <base href="<?=PATH;?>/" />
        <link href="assets/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="./">OCR P5</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="./">ACCUEIL</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main Content-->
        <?php
          echo $main;
        ?>
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                          <?php
                            if ($socialNetworks['twitter']) {
                          ?>
                            <li class="list-inline-item">
                                <a href="<?=$socialNetworks['twitter'];?>" target='_blank'>
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                          <?php}
                          if ($socialNetworks['facebook']) {
                            ?>
                            <li class="list-inline-item">
                                <a href="<?=$socialNetworks['facebook'];?>" target='_blank'>
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <?php}
                            if ($socialNetworks['github']) {
                              ?>
                            <li class="list-inline-item">
                                <a href="<?=$socialNetworks['github'];?>" target='_blank'>
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <?php
                            }
                              if (isset($_SESSION['login']) && $_SESSION['level'] == 1) {
                                ?>
                                <li class="list-inline-item">
                                    <a href="admin">
                                        <span class="fa-stack fa-lg">
                                            <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                            <i class="fa-solid fa-key fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </li>
                                <?php
                              }
                              ?>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Kimealabs 2022</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
