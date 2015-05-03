<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Eicra Mail to PM</title>
        
        <base href="<?php echo $app->urlFor('home') ?>"></base>

        <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/app/css/styles.css">

    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $app->urlFor('home') ?>">Eicra Email PM</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo $app->urlFor('home') ?>">Home</a></li>
                        <li><a href="<?php echo $app->urlFor('mail') ?>">Mail</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                            </ul>
                        </li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <section id="main-container" class="container">
            
            <?php if (isset($flash['alert'])) : ?>

                <div class="alert alert-info">
                    <p><?php echo $flash['alert'] ?></p>
                </div>

            <?php endif; ?>

            <?php echo $yield ?>

        </section>

        <footer class="navbar navbar-inverse navbar-fixed-bottom text-center">
            <p class="text-info">Created By <a href="http://abdmaster.com" target="_blank">Ahmedul Haque Abid</a></p>
        </footer>

        <script type="text/javascript" src="assets/libs/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/app/js/sendmail.js"></script>

    </body>
</html>