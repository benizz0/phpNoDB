# phpNoDB
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fbenizz0%2FphpNoDB.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fbenizz0%2FphpNoDB?ref=badge_shield)

Simple php authentification without database and temp files
it's based with 1 password, no username.

# When use it
if you whant to secure you webpage with password and you cant or no want use server storage / temp server storage

# Requirements
you just need php 7

# How it's work ?
im using TOTP for validate cookies

# Installation and configure

 1. after download `src/lib/` directory on your website, include `lib/auth.php` on your php webpage
 
```
<?php 
include 'lib/auth.php' 
?>
```
    
2.  generate password with php cli, open shell on any computer with cli php and generate new hashed password :

```
php -a
echo password_hash("<password>", PASSWORD_BCRYPT);
```
3.  Generate base64 256 byte key :
	 -  generate 256 byte hex on https://www.random.org/bytes/ 
	 - convert hex to base 64 on https://conv.darkbyte.ru/
	 
4.  Edit `lib/auth.php` for set the new password, base64 key and session time :
```
$basekey = "<base64 key>"; //base 64 256 byte

$password = '<hashed password>'; //password_hash("pass", PASSWORD_BCRYPT)
$time = <session time in seconde>; //session time
```
# limitations

 - one password
 - session time not always correct
 - all user have same cookie if he connect on the same session period


## License
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fbenizz0%2FphpNoDB.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fbenizz0%2FphpNoDB?ref=badge_large)