<?php
    session_start();
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>RVOA App</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize1.css">

    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>
      

    

    <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#login">Log In</a></li>
        <li class="tab"><a href="#signup">Sign Up</a></li>
        
      </ul>
      
      <div class="tab-content">
             
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="index.php" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input id="emailL" name="emailL" type="email"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input id="pwdL" name="pwdL" type="password"required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button class="button button-block"/>Log In</button>
          
          </form>

        </div>
        
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form action="index.php" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input id="fname" name="fname" type="text" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input id="lname" name="lname" type="text"required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input id="email" name="email" type="email"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
                Set A Password<span class="req">*</span>
            </label>
            <input id="pwd" name="pwd" type="password"required autocomplete="off"/>
          </div>
          
          <button type="submit" class="button button-block"/>Get Started</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

          <?php

       

        

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            
        

        $emailerr ="";
        $pwderr = "";
            
       //  echo "post successful";
            // connect to mongodb
           $m = new MongoClient();
         //  echo "Connection to database successfully";

           // select a database
           $db = $m->RVOA;
         //  echo "Database mydb selected";
           $collection = $db->Users;
          // echo "Collection selected succsessfully";
            
        if(isset($_POST['fname'])){

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $pwd = md5(sha1($_POST['pwd'])); 
           



            $check = $collection->findOne(array("email"=>$email));

            if($check){
                echo "<script>alert('User with That email already exists!!')</script>";
            }
            else{
           $document = array( 
              "First Name" => $fname, 
              "Last Name" => $lname, 
              "email" => $email,
              "Password" => $pwd

           );

           $collection->insert($document);
                
                $userName = $collection->findOne(array("email"=>$email));
                
                $_SESSION["name"]=$userName["First Name"];
                $_SESSION["surname"]=$userName["Last Name"];
                 $_SESSION["email"]=$email;
                $_SESSION["id"]=$userName["_id"];
                header("refresh:0.5;url=home.php");
           echo "<script>alert('Sign-up successful!!')</script>";
            }

        }
        elseif(isset($_POST['emailL'])){
        
            $emailL = $_POST['emailL'];
            $pwdL = md5(sha1($_POST['pwdL']));
            
            $verifyEmail = $collection->findOne(array("email"=>$emailL));
            
            if($verifyEmail){
              //  echo "found user email /n";
                
                $verifyPwd = $collection->findOne(array("email"=>$emailL, "Password"=>$pwdL));
            if($verifyPwd){
               // echo "password correct";
                     /* Redirect browser */
                $userName = $collection->findOne(array("email"=>$emailL));
                //print_r($userName["First Name"]);
                $_SESSION["name"]=$userName["First Name"];
                 $_SESSION["surname"]=$userName["Last Name"];
                $_SESSION["email"]=$emailL;
                $_SESSION["id"]=$userName["_id"];
                header("refresh:0;url=home.php");
 
                /* Make sure that code below does not get executed when we redirect. */
                exit;
            }
            else{
                echo "<script>alert('The password you entered does not match the username')</script>";
            }
                    
            }
            else{
                echo"<script>alert('No user with that email address found')</script>";
            }
            
            
        }
        }

        ?>

  </body>
</html>


