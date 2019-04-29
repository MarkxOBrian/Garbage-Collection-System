<?php 
  require_once 'core/init.php';
  include 'includes/head.php';
  include 'includes/navigation.php';
 ?>


<?php 
   

    if (isset($_GET['add'])) {
         $first = $_POST['name'];
            $second = $_POST['name1'];
            $email = $_POST['email'];
            $location = $_POST['location'];
            $phonenos = $_POST['phoneno'];
            $password = $_POST['password'];
            $pwd = $_POST['pwd'];

            $errors = array();

    if ($_POST) {
                $emailQuery = $db->query("SELECT * FROM signup WHERE email = '$email'");
                $emailCount = mysqli_num_rows($emailQuery);

                if ($emailCount !=0) {
                    $errors[] = 'The email you have entered already exists!';
                }
                $required = array('name','location','phoneno');
                foreach ($required as $b) {
                    if (empty($_POST[$b])) {
                        $errors[] = 'Kindly fill all the required Fields';
                        break;
                    }
                }
                if (strlen($phonenos)!=10){
                    $errors[] = 'Phone Number must be 10 characters';
                }


                if (strlen($password) <6){
                    $errors[] = 'Password must be more than 6 characters';
                }

                if ($pwd!=$password) {
                    $errors[] = 'Your Password does not match';
                }
                if (!empty($errors)) {
                    echo display_errors($errors);
                }

                else{
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO signup (first_name, second_name, email, location, password, cellphone) VALUES ('$first','$second','$email','$location', '$hashed', '$phonenos')"; 

            $db->query($sql) or die (mysqli_error($db));
           
           $_SESSION['success_flash'] = 'Client Successfully added!';

            header('Location: indexmain.php');
        }

        }


    }
 ?>

 <?php
 if (isset($_GET['check'])) {
   

$email = ((isset($_POST['Email']))?sanitize($_POST['Email']):'');
$email = trim($email);
$password = ((isset($_POST['Password']))?sanitize($_POST['Password']):'');
    
    $errors = array();

    if ($_POST) {
        if (empty($_POST['Email']) || empty($_POST['Password'])) {
            $errors[] = 'You Must provide email and password';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'You must enter a valid email';
        }
        if (strlen($password) < 6) {
            $errors[] = 'Password must be more than 6 characters';
        }


        $query = $db->query("SELECT * FROM signup WHERE email = '$email'");
        $user = mysqli_fetch_assoc($query);
        $userCount = mysqli_num_rows($query);

        $passworduser = $user['password'];
        if ($userCount < 1) {
            $errors[] = 'That email does not exist in our database';
        }

       if (!password_verify($password, $passworduser)) {
           $errors[] = 'That password does match our records please try again';
       }

        if (!empty($errors)) {
            echo display_errors($errors);
        }
        else{

            $user_id = $user['id'];
            login($user_id);
        }
    }
  }

?> 



<!-- Modal Log In-->
<div id="login" class="modal fade" role="dialog">
  <div class="modal-dialog">
  

    <!-- Modal Log in content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please Log In</h4>
      </div>
      <div class="modal-body">
        <p>
  <form method="POST" action="indexmain.php?check=1">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="Email" required="true" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="Password" required="true">
  </div>
  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Login</button>
</form> 
        </p>
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--End of Modal Login -->

<!-- Modal Company Log In-->
<div id="clogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Log in content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please Log In</h4>
      </div>
      <div class="modal-body">
        <p>
  <form>
  <div class="form-group">
    <label for="cname">Company Name:</label>
    <input type="text" class="form-control" id="cname" required="true" name="cname" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" required="true" name="cemail"placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="cpassword" required="true">
  </div>
  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form> 
        </p>
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--End of Company Modal Login -->


<!-- Modal Register -->
<div id="register" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Register content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Register Below</h4>
      </div>
      <div class="modal-body">

 <p>
   <form method="POST" action="indexmain.php?add=1">
    <div class="form-group">
    <label for="name">First Name:</label>
    <input type="text" class="form-control" id="name" name="name" required="true">
    <small id="name" class="form-text text-muted">
    Your Name should contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </small>
  </div>
  <div class="form-group">
    <label for="name1">Second Name:</label>
    <input type="text" class="form-control" id="name1" name="name1" required="true">
    <small id="name1" class="form-text text-muted">
    Your Name should contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </small>
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="email" required="true" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="location">Location:</label>
    <select class="form-control" id="location" name="location" placeholder="City/Town" required="true">
      <option>Nairobi</option>
      <option>Kisumu</option>
      <option>Mombasa</option>
      <option>Nakuru</option>
      <option>Eldoret</option>
    </select>
    <!-- <input type="text" class="form-control" id="email" required="true" placeholder="County/City/Town"> -->
  </div>
  <br>
  <div class="form-group">
    <label for="pwd">Phone Number:</label>
    <input type="text" class="form-control" id="" name="phoneno" required="true" >
    <small id="" class="form-text text-muted">
    Your Number must be 10 characters long.
    </small>
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="password" required="true" >
    <small id="pwd" class="form-text text-muted">
    Your password must be 6-10 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </small>
  </div>
    <div class="form-group">
    <label for="pwd"> Confirm Password:</label>
    <input type="password" class="form-control" id="pwd" required="true" name="pwd" placeholder="Should Match the First Password Entry">
  </div>
  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
  </form> 
  </p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--End of Modal Register -->



    <!-- /.container-fluid -->
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main box-border">
                    <div id="mi-slider" class="mi-slider">
                        <ul>

                            <li><a href="#">
                                <img src="assets/ItemSlider/images/1.jpg" alt="img01"><h4>Garbage</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/2.jpg" alt="img02"><h4>Garbage</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/3.jpg" alt="img03"><h4>Garbage</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/4.jpg" alt="img04"><h4>Garbage</h4>
                            </a></li>
                        </ul>
                        <ul>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/5.jpg" alt="img05"><h4>Recycling</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/6.jpg" alt="img06"><h4>Recycling</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/7.jpg" alt="img07"><h4>Recycling</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/8.jpg" alt="img08"><h4>Recycling</h4>
                            </a></li>
                        </ul>
                        <ul>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/9.jpg" alt="img09"><h4>E-Waste</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/10.jpg" alt="img10"><h4>E-Waste</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/11.jpg" alt="img11"><h4>E-Waste</h4>
                            </a></li>
                        </ul>
                        <ul>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/12.jpg" alt="img12"><h4>Biomedical Waste</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/13.jpg" alt="img13"><h4>Biomedical Waste</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/14.jpg" alt="img14"><h4>Biomedical Waste</h4>
                            </a></li>
                            <li><a href="#">
                                <img src="assets/ItemSlider/images/15.jpg" alt="img15"><h4>Biomedical Waste</h4>
                            </a></li>
                        </ul>
                        <nav>

                            <a href="#">Garbage</a>
                            <a href="#">Recycling</a>
                            <a href="#">E-Waste</a>
                            <a href="#">Biomedical</a>
                            
                        </nav>
                    </div>
                    
                </div>
                <br />
            </div>
            <!-- /.col -->

            <div class="row">
                <div class="col-md-12">
                     <center><h2 style="align-items: center;">Do you want to be listed? Click on the Button Bellow</h2> </center>
                     <center><p><a href="registercom.php" class="btn btn-success" role="button">Register Company</a></p></center>
                </div>
            </div>
            
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div>
                    <a href="#" class="list-group-item active">Garbage Collection Companies
                    </a>
                    <ul class="list-group">

                        <li class="list-group-item">Zoa Taka LTD
                            <span class="label label-primary pull-right">Nairobi, Mombasa</span>
                        </li>
                        <li class="list-group-item">Garbage DotCom Ltd
                            <span class="label label-success pull-right">NRB, KSM, MSA</span>
                        </li>
                        <li class="list-group-item">Taka Kenya Ltd
                         <span class="label label-danger pull-right">Nairobi</span>
                        </li>
                        <li class="list-group-item">BINS Nairobi Services Ltd
                             <span class="label label-info pull-right">Nairobi</span>
                        </li>
                        <li class="list-group-item">Games & Entertainment
                             <span class="label label-success pull-right">Kisumu, Eldoret</span>
                        </li>
                    </ul>
                </div>
                <!-- /.div -->
                <div>
                    <a href="#" class="list-group-item active list-group-item-success">Recycling Companies
                    </a>
                    <ul class="list-group">

                        <li class="list-group-item">Metrohm AG
                             <span class="label label-danger pull-right">Nairobi</span>
                        </li>
                        <li class="list-group-item">BioKube A/S
                             <span class="label label-success pull-right">Kisumu</span>
                        </li>
                        <li class="list-group-item">Tranbiz waste solutions
                             <span class="label label-info pull-right">MSA</span>
                        </li>

                    </ul>
                </div>
                <!-- /.div -->
                <div>
                    <a href="#" class="list-group-item active">Bio - Medical Waste
                    </a>
                    <ul class="list-group">
                        <li class="list-group-item">Tranbiz Waste Sol
                             <span class="label label-warning pull-right">Nairobi, Mombasa</span>
                        </li>
                        <li class="list-group-item">PLENSER LIMITED
                             <span class="label label-success pull-right">Kisumu, Nakuru</span>
                        </li>
                        <li class="list-group-item">Autoscribe Informatics
                             <span class="label label-info pull-right">Kenya</span>
                        </li>
                        <li class="list-group-item">Nesvax Innovations
                             <span class="label label-primary pull-right">Mombasa, Nairobi</span>
                        </li>
                    </ul>
                </div>
                <!-- /.div -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
                <div>
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Companies</li>
                    </ol>
                </div>
                <!-- /.div -->

                <div class="row">
                    <div class="col-md-4 text-center col-sm-6 col-xs-6">
                        <div class="thumbnail product-box">
                            <img src="assets/img/dummyimg.png" alt="" />
                            <div class="caption">
                                <h3><a href="#">Company One </a></h3>
                                <p>Price : <strong>Ksh 900</strong>  </p>
                                <p>Category : <strong> Recycle Company</strong></p>
                                <p>Location : <strong> Nairobi, Mombasa</strong></p>
                                <p><a class="btn btn-success" role="button" data-toggle="modal" data-target="#login">Book Services</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 text-center col-sm-6 col-xs-6">
                        <div class="thumbnail product-box">
                            <img src="assets/img/dummyimg.png" alt="" />
                            <div class="caption">
                                <h3><a href="#">Company One </a></h3>
                                <p>Price : <strong>Ksh 900</strong>  </p>
                                <p>Category : <strong> Recycle Company</strong></p>
                                <p>Location : <strong> Nairobi, Mombasa</strong></p>
                                <p><a class="btn btn-success" role="button" data-toggle="modal" data-target="#login">Book Services</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 text-center col-sm-6 col-xs-6">
                        <div class="thumbnail product-box">
                            <img src="assets/img/dummyimg.png" alt="" />
                            <div class="caption">
                                <h3><a href="#">Company One </a></h3>
                                <p>Price : <strong>Ksh 900</strong>  </p>
                                <p>Category : <strong> Recycle Company</strong></p>
                                <p>Location : <strong> Nairobi, Mombasa</strong></p>
                                <p><a class="btn btn-success" role="button" data-toggle="modal" data-target="#login">Book Services</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>


                    <div class="row">
                    <div class="col-md-4 text-center col-sm-6 col-xs-6">
                        <div class="thumbnail product-box">
                            <img src="assets/img/dummyimg.png" alt="" />
                            <div class="caption">
                                <h3><a href="#">Company One </a></h3>
                                <p>Price : <strong>Ksh 900</strong>  </p>
                                <p>Category : <strong> Recycle Company</strong></p>
                                <p>Location : <strong> Nairobi, Mombasa</strong></p>
                                <p><a class="btn btn-success" role="button" data-toggle="modal" data-target="#login">Book Services</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 text-center col-sm-6 col-xs-6">
                        <div class="thumbnail product-box">
                            <img src="assets/img/dummyimg.png" alt="" />
                            <div class="caption">
                                <h3><a href="#">Company One </a></h3>
                                <p>Price : <strong>Ksh 900</strong>  </p>
                                <p>Category : <strong> Recycle Company</strong></p>
                                <p>Location : <strong> Nairobi, Mombasa</strong></p>
                                <p><a class="btn btn-success" role="button" data-toggle="modal" data-target="#login">Book Services</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 text-center col-sm-6 col-xs-6">
                        <div class="thumbnail product-box">
                            <img src="assets/img/dummyimg.png" alt="" />
                            <div class="caption">
                                <h3><a href="#">Company One </a></h3>
                                <p>Price : <strong>Ksh 900</strong>  </p>
                                <p>Category : <strong> Recycle Company</strong></p>
                                <p>Location : <strong> Nairobi, Mombasa</strong></p>
                                <p><a class="btn btn-success" role="button" data-toggle="modal" data-target="#login">Book Services</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>       
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

<br>

    <!--Footer -->
        

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <strong>Send a Quick Query </strong>
                <hr>
                <form>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" required="required" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" required="required" placeholder="Email address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <textarea name="message" id="message" required="required" class="form-control" rows="3" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4">
                <strong>Our Location</strong>
                <hr>
                <p>
                     Multimedia University of Kenya,<br />
                                    Just Location, Nairobi, Kenya<br />
                    Call: +254-711-187-760<br>
                    Email: info@smartdisposalke.co.ke<br>
                </p>

                | www.smartdisposalke.co.ke |
            </div>
            </div>
        </div>
        <hr>
    </div>
    <!-- /.col -->
    <div class="col-md-12 end-box ">
        &copy; 2018 | &nbsp; All Rights Reserved | &nbsp; www.smartdisposalke.co.ke | &nbsp; 24x7 support | &nbsp; Email us: info@smartdisposalke.co.ke
    </div>
    <!-- /.col -->
    <!--Footer end -->
    <!--Core JavaScript file  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!--bootstrap JavaScript file  -->
    <script src="assets/js/bootstrap.js"></script>
    <!--Slider JavaScript file  -->
    <script src="assets/ItemSlider/js/modernizr.custom.63321.js"></script>
    <script src="assets/ItemSlider/js/jquery.catslider.js"></script>
    <script>
        $(function () {

            $('#mi-slider').catslider();

        });
		</script>
</body>
</html>
