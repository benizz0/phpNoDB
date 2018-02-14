<?php 
include 'Base32.php';
include 'assert.php';
include 'assertion.php';
include 'afunctions.php';
include 'ParameterTrait.php';
include 'OTPinterface.php';
include 'OTP.php';
include 'TOTPinterface.php';
include 'TOTP.php';


use OTPHP\TOTP;


$basekey = "WZtTHIeoQVX22d6+sG8JpoocfLxFDm+dBCLOJ4G0OqrLyLGSLxgLwjoHfpN7cTw+zcTBwEuQX/5isQLFQhLFN8r4lo1ATW0/hWRr0D4rsQyYBNqugGYfJEo5AjDx22Q9II0JPpEHi7ymUbzhNmNoSRL6J4Qufl8Hc4t5fbG9KKJgQUUWd27xDCSstctHMLFGEYuKcMFUKX+GwYMfcrRuCecxMxJCcBPxOkM//ektTWXilzBewLNF7XE0EA1pK1HIHeAP/ExnS+TqA/1mmKxN6EtAf+4fTnFcvOqMhYS8avHl60x0g44XPeGZkb1Yur8MxW4f5Jylb/ljR/ylmpLkTA=="; //base 64 256 byte

$password = '$2y$10$QzWEu6Cv.cNi1D/r.i/oq.v081hwIWpbOqVFJHFwlqUtdoKZSWTtW'; //password_hash("pass", PASSWORD_BCRYPT)
$time = 43200; //session time

$totp = new TOTP(
    "", 
    $basekey, 
    $time

);



if(isset($_POST['pass'])){
	if(password_verify($_POST['pass'],$password)) {
		setcookie("key",$totp->now(),time()+$time,'/');
		$con = true;
	} else {

		$err = "<span>bad password</span><br>";
	}
}




if(isset($_COOKIE['key'])){
	if($totp->verify($_COOKIE['key'])) $con = true;
}
if(!($con??false)){
	?>
	<!DOCTYPE html>
	<html lang="fr">
	
		<head>
			<title>Authentification</title>
			<meta charset="utf-8">
			<style type="text/css">
				#main {display:block;position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);padding:40px;border:solid black 2px;}
				input {margin: 8px; border:solid grey 1px;}
				span {color:red;font-size: 20px;}
			</style>
		</head>
		<body><div id="main">
			<form action="" method="post">
				<?php echo $err??""; ?>
				password : <input type="password" name="pass"><br>
				<input type="submit" value="submit">
			</form>
		</div>
		</body>
	</html>
	<?php exit();
}

?>