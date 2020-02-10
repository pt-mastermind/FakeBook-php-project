<?php
// start session - to check if this is website user 
session_start();

// only connected users can use this api
if(!isset($_SESSION["user"])){
    header("location:index.php");
  }

// save the user and user id 

$user = $_SESSION["user"];
$user_id = $_SESSION["user_id"];

// database connection 

 $MySQLdb = new PDO("mysql:host=localhost;dbname=login", "root", "");
 $MySQLdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// action variable 

$action = $_POST["action"];
if(isset($_POST["data"])){
    $data = $_POST["data"];
}
if(isset($_POST["data2"])){
    $data2 = $_POST["data2"];
}
if(isset($_POST["data3"])){
    $data3 = $_POST["data3"];
}

// responses - logout / new message / defult 

header("Content-Type: application/json");

switch($action){

    //loguot api
    case "logout":
        session_destroy();
        echo '{"success": "true"}';
        break;

    //check if there is older messages and show them on screen, with sql injection protection.

    case "get_all_messages":
        $cursor = $MySQLdb->prepare("SELECT * FROM posts");
        $cursor->execute();
        $alldata = "";
        foreach($cursor->fetchAll() as $row){

            //user messages with xss protection.

            if ($row["user_id"] == $user_id){
                $alldata = $alldata . "<li><div><h6>".$user."</h6><p id='send1'>".htmlentities($row['post_data'],ENT_QUOTES, "UTF-8")."</p></div></li>";

            }else{
                
                // other messages, with xss protection.

                $alldata = $alldata . "<li><div class='media-body text-right'><h6>".htmlentities($row['username'],ENT_QUOTES, "UTF-8")."</h6><p id='send2' >".htmlentities($row['post_data'],ENT_QUOTES, "UTF-8")."</p><hr><div></li>";
            }
        }

        echo '{"success": "true","data":"'.$alldata.'"}';
        die();
        break;

    //new chat message 

    case "new_post":
         $cursor = $MySQLdb->prepare("INSERT INTO posts (user_id,post_data,username) value (:id,:data,:username)");
         $cursor->execute(array(":id"=>$user_id, ":data"=>$data,":username"=>$user));
         echo '{"success": "true"}';
         break;

    // all blog posts 
    case "get_all_blog":
    $cursor = $MySQLdb->prepare("SELECT * FROM blogp");
    $cursor->execute();
    $alldata = "";

    foreach($cursor->fetchAll() as $row){
     $alldata = $alldata . " <div class='bor'><div class='post'><div class='date'>".htmlentities($row['tdate'],ENT_QUOTES, "UTF-8")."</div><h2 calss='h2o'>".htmlentities($row['heading'],ENT_QUOTES, "UTF-8")."</h2><h6> create by: ".htmlentities($row['username'],ENT_QUOTES, "UTF-8")."</h6><hr class='h2r'><p>".htmlentities($row['blog_data'],ENT_QUOTES, "UTF-8")."</p></div></div></div> <br>  ";
    }
    echo '{"success": "true","data":"'.$alldata.'"}';
    die();
    break;

    //new chat message 

    case "new_blog_post":
         $cursor = $MySQLdb->prepare("INSERT INTO blogp (user_id,blog_data,username,pdate,heading) value (:id,:data,:username)");
         $cursor->execute(array(":id"=>$user_id, ":data"=>$data,":username"=>$user));
         echo '{"success": "true"}';
         break;


    //new post

    case "new_art":
    $cursor = $MySQLdb->prepare("INSERT INTO blogp (heading,tdate,username,blog_data,user_id) value (:data,:data2,:username,:data3,:id)");
    $cursor->execute(array(":data"=>$data,":data2"=>$data2,":username"=>$user,":data3"=>$data3,":id"=>$user_id));
    echo '{"success": "true"}';
    break;

    //default api
    default:
        echo '{"success": "true"}';
        die();


}

?>
