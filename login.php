<!doctype html>
<html lang="fr">
      <head>
      <meta charset="utf-8">
      <title>Login</title>
     <link rel="stylesheet" type="text/css" href="mystyle.css">
      </head>
      <body>
      <a href="inscription.php">Inscription</a>
</br>
      </br>
      </br>
      </br>
<div class="logo"></div>
<div class="login-block">
     <h1>LOGIN</h1>
      <form action="login.php" method="post">
     <fieldset>
      <label for="name">
        Email:<input id="name" type="text" name="email"/><br>
      </label>
      <label for="password">
        Password:<input id="password" type="password" name="password"/><br>
      </label>
     
     <label for="remember_me" class="aligner">
    Remember Me<input class="aligner" type="checkbox" name="remember_me" value="1"/>
      </label>
     
      <label for="sub">
      <input id="sub" type="submit" value="Login"/>
      </label>
      </fieldset>
      </form>
     </div>
</body>
     </html>
       <?php
session_start();

function my_connect_db($host, $username, $passwd, $port, $db)
{
    try
        {
            $conn = new PDO("mysql:host=$host;port=$port;dbname=$db",$username, $passwd);  
        }
    catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    return $conn;
}
//$hash=$_SESSION['hash'];
$conn = my_connect_db('localhost','root','123456',3306,'pool_php_rush');

$email = $_POST['email'];
$password = md5($_POST['password']);
$patt_mail = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/' ;
$patt_pass = '/[a-zA-Z0-9]{3,10}/';

        if(isset($_POST['email']) && isset($_POST['password']))
            {
                
                $result = $conn->prepare("SELECT username, password from users where email = '$email' AND password = '$password'");
                
                $result->execute();
                $res = $result->fetch();
                if ($res != false) 
                 {
                     $_SESSION['name'] = $res['username'];
                     if (isset($_POST['remember_me']))
                         {
                             setcookie('name', $_SESSION['name'], time()+60*60*24*365, '/');  
                         }
                     header("Location: index.php");
                 }
                else
                    echo 'Incorrect email/password';
            }
//  }
?>