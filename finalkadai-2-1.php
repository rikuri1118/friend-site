<?php
$passlist=array( 'finalkadai1' => 'finalpass1', 'finalkadai2' => 'finalpass2');
$hostname = '127.0.0.1';
$username = 'root';
$password = 'dbpass';
$dbname = 'finaldatabase';
$tablename = 'finaltable';

if(!isset($_POST['user']))
{
    echo_auth_page("login");
    exit;
}
$user=$_POST['user'];
$pass=$_POST['pass'];
if( (!isset($passlist[$user])) || $passlist[$user] != $pass)
{
    echo_auth_page("password is incorrect");
    exit;
}
elseif ( $_POST['function'] == "echo_hello_page")
{
   echo_hello_page($user, $pass);
   exit;
}
elseif ($_POST['function'] == "echo_next_page")
{
     echo_next_page($user, $pass);
     exit;
}
////////////////////////////////////////////////////////////////////////
function echo_auth_page($msg)
{
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>login</title>
    </head>
    <body>
        $msg
    <form method="POST" action="finalkadai-2-1.php">
         loginID <input type="text" name="user" value=""><br>
        password <input type="password" name="pass" value=""><br>
        <button type="submit" name="login" value="login">Login</button>
        <input type="hidden" name="function" value="echo_hello_page">
    </form>
    </body>
</html>
EOT;
}
////////////////////////////////////////////////////////////////////////
function echo_hello_page($user ,$pass)
{
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title></title>
    </head>
    <body>
    <form method="post" action="finalkadai-2-1.php">
              ID<input type="id" name="id" value=""><br>
                    comment <input type="comment" name="comment" value=""><br>
                    <button type="submit" name="confirm" value="confirm">confirm</button>
              <input type="hidden" name="user" value="$user">
              <input type="hidden" name="pass" value="$pass">
              <input type="hidden" name="function" value="echo_next_page">
    </form>
    </body>
</html>
EOT;
}
////////////////////////////////////////////////////////////////////////

function echo_next_page($user ,$pass)
{
                global $hostname, $username, $password, $dbname, $tablename;
	$c = $_POST['id'];
	$d = $_POST['comment'];
echo <<<EOT
<!DOCTYPE html>
<html>
  <head>
   <meta charset="UTF-8"/>
  </head>
  <body>
EOT;
echo <<<EOT
	  print"$c";
	  <br>
	  print"$d";
	  <br>
	    <form method="post" action="finalkadai-1.php">   
	    <button type="submit" name="" value="Btn11">finish</button>
	    <input type ="hidden"
                        <input type="hidden" name="function" value="finalkadai-1">
                        <input type="hidden" name="user" value="$user">
                        <input type="hidden" name="pas" value="$pass"> 
EOT;
	    $link = mysqli_connect($hostname,$username,$password);
        	if(! $link){ exit("Connect error!"); }
        	$result = mysqli_query($link,"USE $dbname");
        	if(!$result) { exit("USE failed!"); }
        	$result = mysqli_query($link,"INSERT INTO $tablename SET id='$c',comment='$d'");
         	if(! $result){ exit("INSERT error!"); }
                echo "Create db and table and update succeeded!";
                mysqli_close($link);
echo <<<EOT
           </form>
	   <form method="post" action="finalkadai-2-1.php">   
	        <button type="submit" name="B" value="">back</button>
                <input type="hidden" name="function" value="echo_hello_page">
           </form>
EOT;
echo <<<EOT
    </body>
</html>
EOT;
       }
?>
