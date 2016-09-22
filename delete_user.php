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
      <h1>DELETE USER</h1>
      <form action="delete_user.php" method="post">
      <fieldset>
      <label for="name">
        Name: <input id="name" type="text" name="name" minlength="3" maxlength="10"/><br>
      </label>
      <label for="email">
        Email:<input id="email" type="text" name="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/><br>
      </label>

      <label for="sub">
      <input id="sub" type="submit" value="Delete user" name="delete_user"/>
      </label>
      </fieldset>
      </form>
     </div>
      </body>
      </html>

      <?php

function my_connect_db($host, $username, $passwd, $port, $db)
{
   try {
       $conn = new PDO("mysql:host=$host;port=$port;dbname=$db",$username, $passwd);
       
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e)
       {
           echo "Connection failed: " . $e->getMessage();
       }
   return $conn;
}

      $username=$_POST['name'];
$email=$_POST['email'];

if(isset($_POST['delete_user']) AND $_POST['delete_user']=='Delete user')
    {
        $con = my_connect_db('localhost','root','123456',3306,'pool_php_rush');           
        $stmt = $con->prepare("DELETE FROM users WHERE username='$username' AND email='$email'");
        
        $stmt->execute();
        echo 'User deleted';
    }
        

    
?>