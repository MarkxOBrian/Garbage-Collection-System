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

            echo $first;

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO signup (first_name, second_name, email, location, password, cellphone) VALUES ('$first','$second','$email','$location', '$hashed', '$phonenos')"; 

            $db->query($sql) or die (mysqli_error($db));
            header('Location: indexmain.php');
    }
 ?>

 <?php 
   
   $dbpath = ''; 

    if (isset($_GET['add2'])) {
         $compyname = $_POST['compname'];
            $comemail = $_POST['compemail'];
            $compcat = $_POST['cartegory'];
            $clocation = $_POST['complocation'];
            $compdet = $_POST['compdetail'];
            $cphonenos = $_POST['comphoneno'];
            $cpassword = $_POST['password2'];
            $cpwd = $_POST['pwd2'];
            $saved_image = '';


            $errors = array();
            if ($_POST) {
              
                $emailQuery = $db->query("SELECT * FROM company_reg WHERE comp_email = '$comemail'");
                $emailCount = mysqli_num_rows($emailQuery);

                if ($emailCount !=0) {
                    $errors[] = 'The email you have entered already exists!';
                }
                if (strlen($cphonenos)!=10){
                    $errors[] = 'Phone Number must be 10 characters';
                }


                if (strlen($cpassword) <6){
                    $errors[] = 'Password must be more than 6 characters';
                }

                if ($cpwd!=$cpassword) {
                    $errors[] = 'Your Password does not match';
                }

              if (!empty($_FILES)) {
                  $photo = $_FILES['photo'];
                  $name = $photo['name'];
                  $nameArray = explode('.',$name);
                  $fileName = $nameArray[0];
                  $fileExt = $nameArray[1];
                  $mime = explode('/',$photo['type']);
                  $mimeType = $mime[0];
                  $mimeExt = $mime[1];
                  $tmpLoc = $photo['tmp_name'];
                  $fileSize = $photo['size']; 
                  $allowed = array('png','jpeg','jpg','gif'); 
                  $uploadName = md5(microtime()).'.'.$fileExt;
                  $uploadPath = BASEURL.'complogo/images/'.$uploadName;
                  $dbpath .= '/ProjectMini/complogo/images/'.$uploadName;
                  if ($mimeType != 'image') {
                    $errors[] = 'The file must be an image.';
                  }
                  if (!in_array($fileExt, $allowed)) {
                    $errors[] = 'The file extension must be a png, jpg, jpeg, or gif.';
                  }
                  if ($fileSize > 15000000) {
                    $errors[] = 'The files size must under 15MB.';
                  }
                  if ($fileExt != $mimeExt && ($mimeType == 'jpeg' && $fileExt != 'jpg')) {
                    $errors[] = 'File extension does not match the file.';
                  }
                 }
            
            if (!empty($errors)) {
              echo display_errors($errors);
            }else{

            move_uploaded_file($tmpLoc,$uploadPath);



            $hashed = password_hash($cpassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO company_reg (comp_name, comp_email, comp_category, comp_location, comp_dtls, comp_phone, comp_pwd, comp_logo) VALUES ('$compyname','$comemail','$compcat','$clocation','$compdet','$cphonenos', '$hashed', '$dbpath')"; 

            $db->query($sql) or die (mysqli_error($db));

            $_SESSION['success_flash'] = 'Company Successfully added!';
            
            header('Location: indexmain.php');
          }
        }
    }
 ?>

  

 <?php

if (isset($_GET['checkuser'])) {
   

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


 if (isset($_GET['check'])) {
   

$email = ((isset($_POST['admemail']))?sanitize($_POST['admemail']):'');
$email = trim($email);
$password = ((isset($_POST['admpwd']))?sanitize($_POST['admpwd']):'');
    
    $errors = array();

    if ($_POST) {
        if (empty($_POST['admemail']) || empty($_POST['admpwd'])) {
            $errors[] = 'You Must provide email and password';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'You must enter a valid email';
        }
        if (strlen($password) < 6) {
            $errors[] = 'Password must be more than 6 characters';
        }


        $query = $db->query("SELECT * FROM company_reg WHERE comp_email = '$email'");
        $user = mysqli_fetch_assoc($query);
        $userCount = mysqli_num_rows($query);

        $passworduser = $user['comp_pwd'];
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

            $user_id1 = $user['comp_id'];
            login2($user_id1);
        }
    }
  }

   if (isset($_GET['checksuper'])) {
   

$email = ((isset($_POST['superemail']))?sanitize($_POST['superemail']):'');
$email = trim($email);
$password = ((isset($_POST['superpassword']))?sanitize($_POST['superpassword']):'');
    
    $errors = array();

    if ($_POST) {
        if (empty($_POST['superemail']) || empty($_POST['superpassword'])) {
            $errors[] = 'You Must provide email and password';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'You must enter a valid email';
        }
        if (strlen($password) < 6) {
            $errors[] = 'Password must be more than 6 characters';
        }


        $query = $db->query("SELECT * FROM superadmin WHERE super_email = '$email'");
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

            $user_id3 = $user['super_id'];
            login3($user_id3);
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
  <form method="POST" action="registercom.php?checkuser=1">
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
<!--End of Modal Login -->

<!-- Modal Company Log In-->
<div id="superlogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Log in content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please Log In</h4>
      </div>
      <div class="modal-body">
        <p>
  <form action="registercom.php?checksuper=1" method="POST">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" required="true" name="superemail"placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="superpassword" required="true">
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

<!-- Modal Admnistrator Log In-->
<div id="admlogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Log in content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please Log In</h4>
      </div>
      <div class="modal-body">
        <p>
  <form method="POST" action="registercom.php?check=1">
  <div class="form-group" method=>
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="admemail" name="admemail" required="true" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="admpwd" required="true">
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
<!--End of Modal Administrator Login -->


<!-- Modal Company Register -->
<div id="cregister" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Company Register content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Register Below</h4>
      </div>
      <div class="modal-body">

 <p>
   <form method="POST" action="registercom.php?add2=1" enctype="multipart/form-data">
    <div class="form-group">
    <label for="name">Company Name:</label>
    <input type="text" class="form-control" id="name" name="compname"required="true">
    <small id="name" class="form-text text-muted">
    Your Name should contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </small>
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="compemail" required="true" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="location">Cartegory:</label>
    <select class="form-control" id="location" placeholder="Cartegory" name="cartegory" required="true">
      <option>Home Waste</option>
      <option>Liquid Waste</option>
      <option>Stationary Waste</option>
      <option>Solid Waste</option>
      <option>Bio Hazard Waste</option>
    </select>
  </div>
  <br>
  <div class="form-group">
    <label for="location">Location:</label>
    <select class="form-control" id="location" placeholder="City/Town" name="complocation" required="true">
      <option>Nairobi</option>
      <option>Kisumu</option>
      <option>Mombasa</option>
      <option>Nakuru</option>
      <option>Eldoret</option>
    </select>
  </div>
  <br>
  <div class="form-group">
      <label>Company Description:</label>
      <div>
        <textarea name="compdetail" rows="5" class="form-control form-control-line" required="true"></textarea>
      </div>
  </div>
  <div class="form-group">
    <label for="">Phone Number:</label>
    <input type="text" class="form-control" id="" name="comphoneno" required="true" >
    <small id="" class="form-text text-muted">
    Your Number must be 10 characters long.
    </small>
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="password2" required="true" >
    <small id="pwd" class="form-text text-muted">
    Your password must be 6-10 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
    </small>
  </div>
    <div class="form-group">
    <label for="pwd"> Confirm Password:</label>
    <input type="password" class="form-control" id="pwd" name="pwd2" required="true" placeholder="Should Match the First Password Entry">
  </div>
  <div class="form-group">
    <label for="photo">Upload Company Logo</label>
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="form-control" id="photo" name="photo" required="true">
        </div>
      </div>
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
<!--End of Company Modal Register -->

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
                <div class="col-md-4">
                     <center><h2 style="align-items: center;">Company Registration</h2> </center>
                     <center><p><a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#cregister">Register Company</a></p></center>
                </div>
                <div class="col-md-4">
                     <center><h2 style="align-items: center;">Company Login</h2> </center>
                     <center><p><a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#admlogin">Comapany Login</a></p></center>
                </div>
                <div class="col-md-4">
                     <center><h2 style="align-items: center;">Admin Login</h2> </center>
                     <center><p><a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#superlogin">Admin Login</a></p></center>
                </div>
            </div>
            
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

        <!--===============================================================================================-->
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function(){
            $(this).css('position','relative');
            $(this).css('overflow','hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function(){
                ps.update();
            })
        });
    </script>
<!--===============================================================================================-->
</body>
</html>