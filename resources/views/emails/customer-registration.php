<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>Dear <?php echo $name; ?> ,</p>

<?php if( $ref_by != "" ) { ?>
<p>Congratulations. You are been referred by your friend or Well Wisher for a Training program at BuddhiJeevi.com. Welcome to the world of Learning opportunities. </p>
<p>Please verify your email address by clicking the following link: 
<a href="<?php echo Request::root() ?>/account/email-verification/<?php echo $token; ?>">Click here</a></p>
<p>We request you to kindly update your Profile information after logging in.
You can explore hundreds of Training’s Options of your choice closer to your location. Feel free demonstrate your Interest by clicking on ‘Interested’ against a Course. A representative will get in touch and counsel you further on the benefits offered. We congratulate you on the first step towards your Learning goal. We are here to help you in all possible ways, to realize your dream. </p>
<?php }else{ ?>
	<p>Thank you for signing up with BuddhiJeevi.com. Welcome to the world of Learning opportunities. 
	Please verify your email address by clicking the following link: 
	<a href="<?php echo Request::root() ?>/account/email-verification/<?php echo $token; ?>">Click here</a></p>

	<p>Please update your Profile information after logging in.</p>

	<?php 

	if($role == 1002 ){
		echo "<p>We will be the ground force to Market your course and Program benefits for your students. The Platform will provide you with options to Manage Courses, Create Batches, Track Leads and Enroll Students. Our Unique Marketplace and strategic presence at the Ground level, will ensure you have a Full house for the Trainings you offer. We will get in touch to explore on next steps with  you. </p>";
	}elseif($role == 1003){
		echo "<p>We will provide a plethora of opportunities to do what you the best i.e. Teach. Please update the profile information, about your Skillset and Expertise. We will ensure, the opportunity lands at your door step. </p>";
	}elseif($role == 1004){
		echo "<p>You can explore hundreds of Training’s Options of your choice closer to your location. Feel free demonstrate your Interest by clicking on <string>‘Interested’</strong> against a Course. A representative will get in touch and counsel you further on the benefits offered. We congratulate you in taking a first step towards your Learning goal. We are here to help you in all possible ways, to realize your dream. </p>";
	}
	?>
<?php } ?>
<p>Regards,<br>
BuddhiJeevi Team<br>
<a href="<?php echo Request::root() ?>"><?php echo Request::root() ?></a></p>

</body>
</html>