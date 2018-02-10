<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>Dear <?php echo $name; ?> ,</p>

<p>Thank you for signing up with BuddhiJeevi.com </p>
<p>Please verify your email address first by clicking the following link:</p>
<p><a href="<?php echo Request::root() ?>/account/email-verification/<?php echo $token; ?>">Click here</a></p>

Buddhijeevi.com
<p><a href="?php echo Request::root() ?>"><?php echo Request::root() ?></a></p>

</body>
</html>