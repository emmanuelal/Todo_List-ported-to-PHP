<?php
 require_once("database/connection.php");
 //require_once("function/data_holder.php");

 function add_header($title){
  global $keywords;
  global $description;
?>
<html lang="en">
       <head>
           <meta  charset="utf-8"/>
           <meta name ="keywords"  content="<?php  echo $keywords;  ?>"/>
           <meta name ="description"  content="<?php  echo $description;  ?>"/>
           <title><?php echo $title; ?></title>
           <link type="text/css" rel="stylesheet" href="styles/site.css" media="all" />
           <link type="text/css" rel="stylesheet" href="styles/bootstrap-theme.min.css" media="all" />
           <link type="text/css" rel="stylesheet" href="styles/bootstrap.css" media="all" />
           <script src= "scripts/ajaxloader.js"></script>
          <script src= "scripts/bootstrap.min.js"></script>
           <script src="scripts/header.js"></script>
           <script src="scripts/jquery-1.11.3.js"></script>
       </head>
           <body>
           	     <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Boite Nou</a>
    </div>
    <?php if(isset($_SESSION['user'])){?>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="#">TodoLists</a></li>
         <li><a href="#">Blog</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Profile</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Change Password</a></li>
            <li><a href="#">View Posts</a></li>
            <li><a href="#">View all Pending items</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Messages</a></li>
          </ul>
        </li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php
      return $title;
                     }
?>                  