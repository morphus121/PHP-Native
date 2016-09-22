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
      <h1>Delete Product</h1>
      <form action="delete_product.php" method="post">
      <fieldset>
      <label for="name">
        Name: <input id="name" type="text" name="name"/><br>
      </label>

      <label for="sub">
      <input id="sub" type="submit" value="Delete product" name="delete_product"/>
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

      $name=$_POST['name'];

if(isset($_POST['delete_product']) AND $_POST['delete_product']=='Delete product')
    {
        $con = my_connect_db('localhost','root','123456',3306,'pool_php_rush'); 
        $stmt = $con->prepare("DELETE FROM products WHERE name='$name'");
        //$stmt->bindPram(':name', $name);
        $stmt->execute();
    }
        

    
?>