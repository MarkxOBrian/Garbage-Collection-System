<nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="indexmain.php"><strong>Smart Disposal</strong> System</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right">
                    
                    <li><a href="#" data-toggle="modal" data-target="#login" style="color: red;">Client Login</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#register" style="color: red;">Client Signup</a></li>
                </ul>
            </div>
            </div>
            </nav>
            <?php
                if (isset($_SESSION['success_flash'])) {
                    echo '<div class="bg_success"><h4 class="text-success text-center">'.$_SESSION['success_flash'].'</h4></div>';
                    unset($_SESSION['success_flash']);
                }

                 if (isset($_SESSION['error_flash'])) {
                    echo '<div class="bg_danger"><h4 class="text-danger text-center">'.$_SESSION['error_flash'].'</h4></div>';
                    unset($_SESSION['error_flash']);
                }
            ?>
