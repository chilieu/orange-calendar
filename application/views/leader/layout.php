<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Orange Church Master Calendar</title>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>" >
    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap-datetimepicker.css'); ?>" >

     <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
    <script type="text/javascript" src="<?php echo base_url('public/js/jquery-2.1.1.min.js'); ?>"></script>


    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script src="<?php echo base_url('public/js/moment-with-locales.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/bootstrap-datetimepicker.js'); ?>"></script>

  </head>
  <body>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">OC</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="<?=empty($this->uri->segment(3)) ? "active" : "";?>"><a href="<?=base_url("/leader");?>">Reservation</a></li>

        <li class="dropdown <?=( ($this->uri->segment(1)=="leader-event-approved" || $this->uri->segment(1)=="leader-event-denied" ) && empty($this->uri->segment(2)) ) ? "active" : "";?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Requests <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url("/leader-event-approved/");?>">Approved</a></li>
            <li><a href="<?=base_url("/leader-event-denied/");?>">Denied</a></li>
          </ul>
        </li>

        <li class="<?=($this->uri->segment(3)=="contactAdmin") ? "active" : "";?>"><a href="<?=base_url("/leader/index/contactAdmin");?>">Contact Admin</a></li>
        <li class="<?=($this->uri->segment(3)=="leaderSetting") ? "active" : "";?>"><a href="<?=base_url("/leader/index/profile");?>">Profile</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/login/leaderLogout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

    <div class="container">

    <?=@$_body?>

    </div><!-- /.container -->

  </body>
</html>