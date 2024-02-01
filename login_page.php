<?php
  	if(isset($_SESSION['admin'])){
    	header('location: admin/home.php');
  	}

    if(isset($_SESSION['voter'])){
      header('location: home.php');
    }
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/anon_header.php'; ?>

<body class="" style="background: url('dist/img/creds-bg.jpg'); background-size: cover;">

<div class="login-box" >
  	<div class="login-logo">
  		<b style="color: white;">Voting System</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to start your session</p>

    	<form action="login.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="voter" placeholder="Voter's ID" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      		</div>
    	</form>
  	</div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo '
			  <div class="c-container">
					<div class="alert alert-danger alert-dismissible" style="width: 100%;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<ul>
							<li>' . $_SESSION["error"] . '</li>
						</ul>
					</div>
				</div>
  			';
  			unset($_SESSION['error']);
  		}
  	?>
</div>


<?php include 'includes/anon_footer.php'; ?>

<?php include 'includes/scripts.php' ?>
</body>
</html>