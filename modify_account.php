      <?php
session_start();
function my_connect_db($host, $username, $passwd, $port, $db)
{
   try {
       $conn = new PDO("mysql:host=$host;port=$port;dbname=$db",$username, $passwd);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo ""."\n";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
return $conn;
}

$name = $_SESSION['name'];

$conn=my_connect_db('localhost','root','123456',3306,'pool_php_rush');

$result = $conn->prepare("SELECT * from users WHERE username = '$name'");
$result->execute();
$res = $result->fetch();

$name1 = $res['username'];
$email1 = $res['email'];
$password1 = $res['password'];
$id = $res['id'];

if (isset($_POST['edit']) == "edit")
    {
        $password_update = $_POST['password'];
        $name_update = $_POST['name'];
        
        $email_update = $_POST['email'];
        $stmt = $conn->prepare("UPDATE users SET username='$name_update', email='$email_update', password='$password_update' WHERE id ='$id'");
        $stmt->execute();
        $retour = $stmt->fetch();
        if ($retour != false)
            {
                //echo 'User updated';
            }
    }
    
?>

<!doctype html>
<html lang="fr">
      <head>
      <meta charset="utf-8">
      <title>Registration form that saves a user in a database</title>
      <link rel="stylesheet" type="text/css" href="mystyle.css">
      </head>
      <body>
<div class="logo"></div>
<div class="login-block">
     <h1>MODIFY ACCOUNT</h1>
      <form action="modify_account.php" method="POST">
      <label for="name">
        Name: <input id="name" type="text" name="name" minlength="3" maxlength="10" value="<?php echo $name1; ?>"/><br>
      </label>
      <label for="email">
        Email:<input id="email" type="text" name="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $email1; ?>"/><br>
      </label>
      <label for="password">
        Password:<input id="password" type="password" name="password"  minlength="3" maxlength="10" value="<?php echo $password1 ?>"/><br>
      </label>

      <label for="sub">
      <input id="sub" type="submit" value="edit" name="edit"/>
      </label>
      </form>
     </div>
      </body>
      </html>

