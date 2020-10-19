<!DOCTYPE html>
<html lang="en">
<head>
  <title>Facebook and Google Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    .social_info{
      text-align: center;
      font-color:#FFFFFF;
      font-size: 25px;
      padding: 10px;
      background-color: #08437b;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Portfolio</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Gallery</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container text-center">    
    <p>Google and facebook login</p>
  </div>
</div>
  
<div class="container-fluid bg-3 text-center">    
  <div class="row">

    <?php if($this->session->flashdata('message')){?>
    <div class="col-sm-12">
      <div class="container-fluid bg-3 text-center">    
        <div class="alert alert-success"><?php echo $this->session->flashdata('message');?></div>
      </div>
    </div>
  <?php } ?>


    <div class="col-sm-6">
       <div class="social_icon">
          <a href="<?php echo $this->facebook->login_url(); ?>" class="social_info btn btn-success btn-lg" >Facebook ligin</a>
        </div>
    </div>

    <div class="col-sm-6"> 
      <div class="social_icon">
          <a href="<?php echo $login_url?>" class="social_info btn btn-success btn-lg" ><i class='fas fa-google'></i>Google login</a>
      </div>
    </div>
    
  </div>
</div><br>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
