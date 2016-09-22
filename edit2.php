      <?php
session_start();
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

$name = $_GET['name'];

$con=my_connect_db('localhost','root','123456',3306,'pool_php_rush');
$result = $con->prepare("SELECT * from products WHERE name = '$name'");
$result->execute();
$res = $result->fetch();


$name1 = $res['name'];
$price = $res['price'];
$category_id = $res['category_id'];
$id = $res['id'];

if (isset($_POST['edit_product']) AND $_POST['edit_product'] == "Edit Product")
    {     
        $name_update = $_POST['name'];
        $price_update = $_POST['price'];
        $category_id_update = $_POST['category_id'];
   
        $ret = $con->prepare("UPDATE products SET name='$name_update', price='$price_update', category_id='$category_id_update' WHERE id ='$id'");
        
        $ret->execute();   
        $retour = $ret->fetch();
    }
?>


<!doctype html>
<html lang="fr">
      <head>
      <meta charset="utf-8">
      <title></title>
      <link rel="stylesheet" type="text/css" href="mystyle.css">
      </head>
      <body>
<div class="logo"></div>
<div class="login-block">
     <h1>Edit Product</h1>
    <form action="edit2.php?name=<?php echo $name ?>" method="POST">
      <label for="name">
        Name: <input id="name" type="text" name="name" value="<?php echo $name1; ?>"/><br>
      </label>
      <label for="price">
        Price:<input id="price" type="text" name="price" value="<?php echo $price; ?>"/><br>
      </label>
      <label for="category_id">
       Category_id:<input id="category_id" type="text" name="category_id" value="<?php echo $category_id; ?>"/><br>
      </label>

      <label for="sub">
      <input id="sub" type="submit" value="Edit Product" name="edit_product"/>
      </label>
      </form>
     </div>
      </body>
      </html>

