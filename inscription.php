<!doctype html>
<html lang="fr">
      <head>
      <meta charset="utf-8">
      <title>Registration form that saves a user in a database</title>
      <link rel="stylesheet" type="text/css" href="mystyle.css">
      </head>
      <body>

      
<a href="login.php">Login</a>
      <div class="logo"></div>
<div class="login-block">
      <h1>INSCRIPTION</h1>
      <form action="inscription.php" method="post">
      <fieldset>
      <label for="name">
        Name: <input id="name" type="text" name="name" minlength="3" maxlength="10"/><br>
      </label>
      <label for="email">
        Email:<input id="email" type="text" name="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/><br>
      </label>
      <label for="password">
        Password:<input id="password" type="password" name="password"  minlength="3" maxlength="10"/><br>
      </label>
      <label for="password_confirmation">
          Password confirmation:<input id="password_confirmation" type="password" name="password_confirmation"  minlength="3" maxlength="10"/><br>
      </label>
      <label for="sub">
      <input id="sub" type="submit" value="Submit"/>
      </label>
      </fieldset>
      </form>
     </div>
      </body>
      </html>

      <?php
      //session_start();
function my_connect_db($host, $username, $passwd, $port, $db)
{
   try {
       $conn = new PDO("mysql:host=$host;port=$port;dbname=$db",$username, $passwd);
   }
   catch(PDOException $e)
       {
           echo "Connection failed: " . $e->getMessage();
       }
   return $conn;
}

   if (!empty($_POST))
       {
           $username=$_POST['name'];
           $email=$_POST['email'];
        
           $password=$_POST['password'];
           // $hash=password_hash($password,PASSWORD_DEFAULT);
           //$_SESSION['hash']=$hash;
           $password_confirmation=$_POST['password_confirmation'];
           
           if ($password != $password_confirmation)
               {
                   echo '<p class="MSGIP">Invalid password or password confirmation</p>';
               }
           
           else if (strlen($username) < 3 || strlen($username) > 10)
               {
                   echo '<p class="MSGIU">Invalid username</p>';
               }
           
          else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
               {
                   echo '<p class="MSGIE">Your adress email is not valid</p>';
               }
           else
               {
                   $conn = my_connect_db('localhost','root','123456',3306,'pool_php_rush');
                   
                   $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
                   
                   $stmt->bindParam(':username', $username);
                   $stmt->bindParam(':password',md5($password));
                   $stmt->bindParam(':email', $email);
                   
                   $stmt->execute();
                   echo '<p class="MSGUC">User created</p>';
               }
       }
   
?>