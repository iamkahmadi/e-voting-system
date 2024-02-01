<?php
// session_start();
// if(isset($_SESSION['admin'])){
// 	header('location: admin/home.php');
// }

// if(isset($_SESSION['voter'])){
//   header('location: home.php');
// }
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/anon_header.php'; ?>

<body class="hold-transition">

	<body>

		<div class="container-fluid">
			<!-- <h4>E-Voting System</h4>
			<h1>Unbiased Casting and voting system</h1> -->
		</div>



		</div>
		<?php
		if (isset($_SESSION['error'])) {
		?>
			<div class="c-container">
				<div class="alert alert-danger alert-dismissible" style="width: 100%;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<ul>
						<?php
						echo "
							<li>" . $_SESSION['error'] . "</li>
						";
						?>
					</ul>
				</div>
			</div>
		<?php
			unset($_SESSION['error']);
		}
		if (isset($_SESSION['success'])) {
			echo "
			<div class='c-container'>
				<div class='alert alert-success alert-dismissible'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<h4><i class='icon fa fa-check'></i> Success!</h4>
				" . $_SESSION['success'] . "
				</div>
			</div>
			";
			unset($_SESSION['success']);
		}

		?>


		<div class="c-home-container">
			<h1>E-Voting System</h1>

			<h2>Introduction</h2>
			<p>An e-voting system, also known as electronic voting, is a digital method of casting and counting votes. It replaces traditional paper-based voting systems with electronic devices, allowing for more efficient and accurate voting processes.</p>

			<h2>Advantages of E-Voting</h2>
			<ul>
				<li>Convenience: E-voting eliminates the need for physical presence at polling stations, enabling voters to cast their votes from anywhere with an internet connection.</li>
				<li>Accessibility: E-voting systems can be designed to accommodate individuals with disabilities, ensuring equal voting rights for all citizens.</li>
				<li>Efficiency: E-voting reduces the time required for vote counting and result declaration, speeding up the election process.</li>
				<li>Accuracy: With built-in validation and verification mechanisms, e-voting systems minimize the chances of errors in vote counting and result tabulation.</li>
				<li>Cost-saving: E-voting eliminates the need for printing and distributing paper ballots, leading to significant cost savings for electoral authorities.</li>
			</ul>

			<h2>Security Measures</h2>
			<p>E-voting systems employ various security measures to ensure the integrity and confidentiality of votes:</p>
			<ul>
				<li>Encryption: Votes are encrypted to prevent unauthorized access and tampering.</li>
				<li>Authentication: Voters are authenticated to ensure only eligible individuals can cast their votes.</li>
				<li>Auditability: E-voting systems maintain an audit trail, allowing for verification and investigation of any suspicious activities.</li>
				<li>Firewalls and Intrusion Detection Systems (IDS): These are implemented to protect the voting system from external threats.</li>
				<li>Regular Updates: The system is regularly updated with security patches to address any vulnerabilities.</li>
			</ul>

			<h2>Challenges and Concerns</h2>
			<p>Despite the advantages, e-voting systems also face challenges and concerns:</p>
			<ul>
				<li>Technological Limitations: Not all voters may have access to the necessary technology, such as computers or smartphones, to participate in e-voting.</li>
				<li>Cybersecurity Risks: E-voting systems are vulnerable to hacking, tampering, or denial of service attacks, potentially compromising the integrity of the election.</li>
				<li>Trust and Transparency: Some individuals may question the transparency and reliability of e-voting systems, as they rely on complex algorithms and software.</li>
				<li>Privacy: Ensuring the privacy of voters' choices while maintaining the anonymity of their identities is a critical concern.</li>
				<li>Digital Divide: E-voting may exacerbate the digital divide, as certain demographics or regions may have limited access to technology or reliable internet connectivity.</li>
			</ul>

			<h2>Conclusion</h2>
			<p>E-voting systems offer numerous advantages in terms of convenience, accessibility, efficiency, accuracy, and cost-saving. However, it is crucial to address the security, trust, and privacy concerns associated with these systems to ensure fair and reliable elections.</p>
		</div>





		<?php include 'includes/anon_footer.php'; ?>



		<?php include 'includes/scripts.php' ?>
	</body>

	</html>