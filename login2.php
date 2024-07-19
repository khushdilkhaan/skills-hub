<?php require_once 'connection.php' ?>
<?php
    if(!(isset($_GET["roll"]))){
            header("location:index.php");
    }


    if(isset($_SESSION["admin_email_session"]) and isset($_SESSION["admin_password_session"])){
            header("location: admin/index.php");
    }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Manager’s Dashboard System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="login2.css">
    <style>
        .ErrorColor{
            color:red;
        }
    </style>
</head>
<body>
    



    <div class="container">
    <?php 

$email  =  $password = "";
$emailErr = $passwordErr = "";

 if(isset($_POST["login"])){

    $role = $_GET["roll"];


     if (empty($_POST["email"])) {
       $emailErr = "* Email is required";
   } else {
       $email = $_POST["email"];
   }



       // Validate password field
   if (empty($_POST["password"])) {
       $passwordErr = "* Password is required";
   } else {
       $password =$_POST["password"];
   }


   if (empty($emailErr) && empty($passwordErr)) {


    if($role == "admin"){   
       // php step  # 01  [  Query write ]
   $query  = "select * from users where email = '$email' and password = '$password' and role = '$role'";

   // php step # 02 [ Quey run or execute ]
   $exe = mysqli_query($link,$query);

   // Php step # 03 [  checking ]

     if(mysqli_num_rows($exe) >= 1){
        $_SESSION["admin_email_session"] = $email;
        $_SESSION["admin_password_session"] = $password;
           header("location: admin/index.php");
     }else{
       echo '
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Dear!</strong> Invalid Email Or Password
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
         ';
     }


    }elseif($role == "user"){


// php step  # 01  [  Query write ]
   $query  = "select * from users where email = '$email' and password = '$password' and role = '$role'";

// php step # 02 [ Quey run or execute ]
   $exe = mysqli_query($link,$query);

// Php step # 03 [  checking ]

     if(mysqli_num_rows($exe) >= 1){
        $_SESSION["user_email_session"] = $email;
        $_SESSION["user_password_session"] = $password;
           header("location: user/index.php");
     }else{
       echo '
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Dear!</strong> Invalid Email Or Password
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
         ';
     }
      
    }     elseif($role == "worker"){


        // php step  # 01  [  Query write ]
           $query  = "select * from skilledworkers where email = '$email' and password = '$password' and role = 'worker'";
        
        // php step # 02 [ Quey run or execute ]
           $exe = mysqli_query($link,$query);
        
        // Php step # 03 [  checking ]
        
             if(mysqli_num_rows($exe) >= 1){
                $_SESSION["worker_email_session"] = $email;
                $_SESSION["worker_password_session"] = $password;
                   header("location: skillworker/index.php");
             }else{
               echo '
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Dear!</strong> Invalid Email Or Password
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
                 ';
             }               
            }else{
        echo " Wait";
    }
    


   }
}

  
 
  
?>
        <div class="mycard">
            <div class="row">
            



                <div class="col-md-6">
                    <div class="myLefctn">
                        <form  method="post" class="MyForm text-center">
                            <header>Login As <span style="color:red"><?php echo $_GET["roll"]; ?></span></header>

                            <div class="form-group ">
                                <i class="fas fa-user"></i>
                                <input class="myInput" type="email" name="email" placeholder="Email" id="username" value="<?php if(isset($_POST["email"])){ echo $_POST["email"];  } ?>">
                                <div class="ErrorColor"><?php echo  $emailErr; ?></div>
                            </div>


                            <div class="form-group ">
                                <i class="fas fa-lock"></i>
                                <input class="myInput" name="password" type="password" placeholder="Password" id="passwrod">
                                <div class="ErrorColor"><?php echo  $passwordErr; ?></div>
                            </div>

                           

                           <input type="submit" class="button-1" name="login" value="LOGIN NOW"> 

                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="myRightCtn">
                        <div class="box"><header><?php echo $_GET["roll"]; ?>  </header></div>
                        <p style="text-align: center;">
                           Please Provide Your User Name and Password To Login Into the System <br>
                           <span style="color:blue">Don't have an account?</span> <br>
                           Please ask the administrator to have an access to
                    Dashboard Management System File Storage System.
                        </p>
                        <!-- <input type="submit" value="Learn More" class="button-out"> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



<!-- jQuery -->
<script src="Assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="Assets/dist/js/adminlte.min.js"></script>

</body>
</html>
