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


$basekey = ""; //base 64 256 byte

$password = ''; //password_hash("pass", PASSWORD_BCRYPT)
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
