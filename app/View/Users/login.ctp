<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CRM VMP</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <?php
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('style.min');
        echo $this->Html->css('skin-blue.min');
        ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style type="text/css">
  	.login-page, .register-page {
    	background-image: url("/img/background/dwa2.jpg");
    	background-size: cover;
	}
	.login-box-body, .register-box-body {
    background: #fff;
    padding: 20px;
    border-top: 0;
    box-shadow: 0px 0px 11px 5px #b1afaf;
    color: #666;
}
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>CRM </b>VMP</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Bienvenue dans CRM VMP</p>

    <?php echo $this->Form->create('User'); ?> 
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="data[User][username]">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="mot de passe" name="data[User][password]">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
      	<div class="col-md-8"></div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Connexion</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<?php
        echo $this->Html->script('jquery-2.2.3.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('app.min');
        ?>
<script>
$(function () {
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' // optional
	});
});
$(window).load(function(){
	var text1 = $("#flashMessage").text();
	var htm1 = "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Alert!</strong>&nbsp;&nbsp;"+text1;
	$("#flashMessage").html(htm1);
	$("#flashMessage").attr("class", "alert alert-success fade in");
	$("#flashMessage").attr("style", "background:#3c8dbc !important;border-color:#3c8dba;");
	var text2 = $("#authMessage").text();
	var htm2 = "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Alert!</strong>&nbsp;&nbsp;"+text2;
	$("#authMessage").html(htm2);
	$("#authMessage").attr("class", "alert alert-danger fade in");		
});
</script>
</body>
</html>
