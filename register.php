<?php
if (isset($_SESSION['admin'])) {
    header('location: admin/home.php');
}

if (isset($_SESSION['voter'])) {
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
            <p class="login-box-msg">Register to start your session</p>

            <form action="process_registration.php" method="POST" enctype="multipart/form-data">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="firstname" name="firstname" required="" placeholder="First Name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="lastname" name="lastname" required="" placeholder="Last Name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="id_no" placeholder="ID No" required>
                </div>
                <div class="form-group text-start">
                    <label for="photo" class="col-sm-12 text-start">ID Card Photo</label>
                    <input type="file" id="photo" name="photo" class="form-control">
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="register"><i class="fa fa-sign-in"></i> Sign Up</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        if (isset($_SESSION['error'])) {
            echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>" . $_SESSION['error'] . "</p> 
			  	</div>
  			";
            unset($_SESSION['error']);
        }
        ?>
    </div>


    <?php include 'includes/anon_footer.php'; ?>
    <?php include 'includes/scripts.php' ?>
</body>

</html>