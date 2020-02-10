<?php 
// session start

session_start();
// end

// check if there is a user session if not send him to index.php

if(!isset($_SESSION["user"])){
  header("location:index.php");
}

// save the user session 

$user = $_SESSION["user"];
$user_id = $_SESSION["user_id"];

$hello = "<h1>hello $user</h1>";

?>
<!-- start of html -->

<!DOCTYPE html>
<html>
<head>
  <!-- bootstrap 4, ajax, jquery, google fonts links -->
  <link rel="stylesheet" type="text/css" href="blog2.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="chat.css">
<link href="https://fonts.googleapis.com/css?family=Modak|Volkhov&display=swap" rel="stylesheet">
  <!-- end -->
  <!-- page title -->
  <title>Fakebook</title>
  <!-- end -->
<body>
<!-- font for blog -->
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic|Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
<!-- end -->
  <!-- css -->
<style>
#navfix{
  overflow: scroll; 
  position: -webkit-sticky;
  position: sticky;
  top:0;
}
.new_post1{
  width: 80%;
  background-color: whitesmoke;
  border: 20px solid black;
  font-family: 'Source Sans Pro', sans-serif;
  padding: 20px;
  margin: 20px auto;
  max-width: 700px;
  overflow: scroll; 
  position: -webkit-sticky;
  position: sticky;
  top:0;
}
#atext{
  width: 100%;
}

#mr{
  padding: 10px;
}

#stiky{
      position: -webkit-sticky;
      position: sticky;
      top:0;
    }
#mtitle{
      text-align: center;

}
#mnav:hover{
     transform: scale(1.20);
}
#mnav{
      font-size: 150%;
      color:whitesmoke;
  }
#chat{
  margin-top:27.5%;
  border-style: double;
  border-width: 10px;
  border-color: black;
  position: -webkit-sticky;
  position: sticky;
  bottom:0;
}
#Fhead{
  text-align: center;
  font-family: 'Volkhov', serif;
  font-size: 40px;
}

#Fhead:hover{
  transform: scale(1.08);
}
#jumb{
      margin: 8%;

}

#toggle{
  margin-top:50%;
  width: 20%;
  position: -webkit-sticky;
  position: sticky;
  bottom:0;
}

#send{
  margin-left: 29%;
}
#send1{
  margin-bottom: 20%;
  color:darkblue;
}
#sned2{
  color: black;
}
#chathd {
  overflow: scroll;
}

div.ex1 {
  margin-bottom: 30%;
  width: 100%;
  height: 160px;
  overflow: scroll;
}
#blog_posts{
  overflow: scroll;
}

#show_post1{
  padding-left: 80%;
}

#main_blog{
  padding-left: 43%;
}
</style>
  <!-- css end -->
<!-- navbar start -->
<nav  id="stiky" class="navbar navbar-dark bg-dark">
  <!-- Navbar content -->
  <a class="navbar-brand" id="mnav">Fakebook</a>
  <div id="show_post1"><button id="show_post2" type="submit" class="btn btn-primary">New post</button></div>
  <form class="form-inline">
  <button id="logout" type="submit" class="btn btn-primary">Logout</button>
  </form>
</nav>
<!-- end -->

<!-- main title -->
<?php 
$user2 = htmlentities($user, ENT_QUOTES, "UTF-8");
echo "<h1 id='mtitle' class='display-4'>welcome $user2, to Fakebook chat and posts</h1>"

?>
<!-- end -->

<!-- new post -->

<div class="new_post1">
<h1 id="mr">new post</h1>
  <div>
  <input type="text"  id="date" placeholder="date">
  <input type="text"  id="ptitle" placeholder="title">
  </div>
<input id="atext" type="text">

<div>
<button class="tnew_post" type="button">submit</button>
<input type="submit" id="nhide" value="hide">
</div>
</div>

<!-- end -->

<!-- blog posts -->

<!-- main blog -->
<h1 id="main_blog">blog posts</h1>
<!-- end -->

<div id="blog_posts">

</div>
<!-- end -->

<!-- chat -->
<!-- chat button -->
<button id="toggle" type="button" class="btn btn-dark">Chat</button>
<!-- end button -->
<div id="chat" class="col-sm-3 col-sm-offset-4 frame">
<h4 id="Fhead">Chat</h4>
<hr>          
              <!-- chat interface -->
            
            <ul id="chath" class="chat history">
            <div class="ex1">
              <div>
            </ul>
            
            <!-- end -->
            <div class="tchat">
                <div class="msj-rta macro" style="margin:auto">                        
                    <div class="text text-r" style="background:whitesmoke !important">
                        <input id="cmsg" class="mytext" type=text name="cmsg" placeholder="Type a message"/>
                        <hr>
                        <button id="send" type="button" class="btn btn-secondary">Send</button>
                    </div> 
                </div>
            </div>
        </div> 

<!-- end -->

<!-- jquery scripts -->
<script>
// hide the chat button  onload 
$("#toggle").hide();

// hide the chat and pop up the chat button
$("#Fhead").click(function(){
  $("#chat").toggle();
  $("#toggle").toggle();
});

// hide chat button and pop up the chat
$("#toggle").click(function(){
$("#chat").toggle();
$("#toggle").hide();
});

//load chat messagess

setInterval(function(){
  $.post("api.php",{"action":"get_all_messages"}, function(data){
  if(data.success == "true"){
    $(".ex1").html(data.data);
  }
 });

},2000);

// logout function
$("#logout").click(function(){
  $.post("api.php",{"action":"logout"}, function(data){
    if(data.success == "true"){
      location.href = "index.php";
    }
  });
});

// send message function

$("#send").click(function(){
  $.post("api.php",{"action":"new_post","data":$("#cmsg").val()}, function(data){
    if(data.success == "true"){
      $.post("api.php",{"action":"get_all_messages"}, function(data){
    if(data.success == "true"){
      $(".ex1").html(data.data);
      $("#cmsg").val("");
  }
 });
    }
  });
});

// get all messages function

$.post("api.php",{"action":"get_all_messages"}, function(data){
  if(data.success == "true"){
    $(".ex1").html(data.data);
  }
 });

 // get all posts function

$.post("api.php",{"action":"get_all_blog"}, function(data){
  if(data.success == "true"){
    $("#blog_posts").html(data.data);
  }
 });

 // new blog post
$(".tnew_post").click(function(){
  $.post("api.php",{"action":"new_art","data":$("#ptitle").val(),"data2":$("#date").val(),"data3":$("#atext").val()}, function(data){
    if(data.success == "true"){
      location.reload();
    }else{
      alert("no");
    }
  });
});
// hide the show new post button onload 
$(".new_post1").hide();

// hide button blog post
$("#show_post2").click(function(){
  $(".new_post1").toggle();
});

$("#nhide").click(function(){
  $(".new_post1").toggle();
});

</script>
<!-- end -->
</body>
</html>
