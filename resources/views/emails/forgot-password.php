<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>Dear <?php echo $name; ?> ,</p>

<p>Recently a request was submitted to reset your password for our members area. If you did not request this, please ignore this email. It will expire and become useless in 2 hours time.

<p>To reset your password, please visit the url below:</p>
<p><a href="<?php echo Request::root() ?>/account/reset-password/<?php echo $token; ?>">Click here to reset your password</a></p>

BuddhiJeevi
<p><a href="http://www.buddhijeevi.com">www.buddhijeevi.com</a></p>

</body>
</html>