    <!-- Main php -->
    <?php
    /* create session */
    session_start();
    if(isset($_SESSION["user"])){
        header("location: main.php");
    }
    /* end */
    /* database connection */
         $MySQLdb = new PDO("mysql:host=localhost;dbname=login", "root", "");
         $MySQLdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         /* database connection end */

                /* login */
                if (isset($_POST["username"]) && isset($_POST["password"])){
                    $cursor = $MySQLdb->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
                    $cursor->execute(array(":username"=>$_POST["username"], ":password"=>$_POST["password"]));
                    /* login faild */
                    if(!$cursor->rowCount())
                    {
                        $msg =  "Wrong Username/Password!<br>";
                    }
                    else
                    {
                    /* login success */
                        $return_array = $cursor->fetch();
                        
                        $_SESSION["user"]    = $return_array["username"];
                        $_SESSION["user_id"]  = $return_array["id"];
                        
                        /* set cookie */
                        die(Header("Location: main.php"));
                    }
                    
                 }
                 /* login end */

         /* regester */
         if (isset($_POST["r_username"]) && isset($_POST["r_password"])){

                $cursor = $MySQLdb->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
                $cursor->execute(array(":username"=>$_POST["r_username"], ":password"=>$_POST["r_password"]));

             if ($cursor->rowCount()){
                 $msg2 = "user already exist";
             }else {
                $cursor = $MySQLdb->prepare("INSERT INTO users (username, password) value (:username,:password)");
                $cursor->execute(array(":username"=>$_POST["r_username"], ":password"=>$_POST["r_password"]));

                $msg2 = "registered successfully";
             }

         }
            /* regester end*/

  
    ?>
    <!--  end  -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- bootstrap 4, ajax, jquery links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- end -->
    <!-- page title -->
    <title>Fakebook</title>
    <!-- end -->
</head>

<body>
    <!--all css-->
    <style type="text/css">
        #jumb1{
            margin: 12%;
        }
        #fa:hover{
            transform: scale(1.30);
        }
        #ho:hover{
            transform: scale(1.50);
        }
        #pus:hover{
            transform: scale(1.10);
        }
 
    </style>
    <!--end css-->
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" id="fa" href="http://192.168.64.2/fakebook/#">FakeBook</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            </ul>
            <!-- Navbar - login form -->
            <form class="form-inline my-2 my-lg-0" action="index.php" method="POST">
                <input class="form-control mr-sm-2" type="username" placeholder="username" name="username" aria-label="email">
                <input class="form-control mr-sm-2" type="password" placeholder="password" aria-label="password" name="password">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Login</button>
            </form>
            <!-- end -->
        </div>
    </nav>
    </div>
    <!--Nav bar end-->
    <!-- Check username and password -->
    <?php
 if (isset($msg)){
    echo '<style>
    #msg{
        padding: 1%;
        position: absolute;
        left: 76%;
        top: 7%;
    }
    </style><div id="msg" class="alert alert-success" role="alert">
    '.$msg.'
  </div>' ;
 }
    ?>
    <!-- end -->

    <!--Banner start-->
    <div class="jumbotron" id="jumb1">
        <h1 class="display-4">Welcome to fakebook!</h1>
        <p class="lead">Fakebook is the best platform to learn cyber security and programing, here everyone are students and teachers at the same time! this way anyone can learn something new every day, so have you signup already? join us and become one of most professional hacker or programmer in the entire world!  </p>
        <hr class="my-4">
        <p>If you want to register you can sign-up here!</p>
        <!-- register -->
        <div>
        <form class="form-inline" action="index.php" method="POST">

        <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text">Username</div>
    </div>
    <input type="text"  name="r_username" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
  </div>

  <label class="sr-only" for="inlineFormInputGroupUsername2">password</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text">password</div>
    </div>
    <input type="text" name="r_password" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Password">
  </div>

  <button type="submit" class="btn btn-primary mb-2">Submit</button>
  <!-- register form message -->
  <?php
 if (isset($msg2)){
    echo '<style>
    #msg{
        padding: 1%;
        position: absolute;
        left: 20%;
        top: 61%;
    }
    </style><div id="msg" class="alert alert-primary" role="alert">
    '.$msg2.'
  </div>' ;
 }
    ?>
    <!-- end -->
</form>
        </div>
        <!-- end -->
    </div>
    <!--banner end(jumbotron)-->
</body>

</html>