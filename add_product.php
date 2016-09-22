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
        $product_name=$_POST['name'];
        $product_price=$_POST['price'];

if(isset($_POST['add_product']) AND $_POST['add_product']=='Add product')
    {
        $conn = my_connect_db('localhost','root','123456',3306,'pool_php_rush');
        $stmt = $conn->prepare("INSERT INTO products (name, price, category_id) VALUES (:name, :price, :category_id)");
        $stmt->bindParam(':name', $product_name);
        $stmt->bindParam(':price', $product_price);
        $stmt->bindParam(':category_id', $_POST['select']);
        $stmt->execute();
    }
        
$conn = my_connect_db('localhost','root','123456',3306,'pool_php_rush');
$stmt = $conn->prepare("SELECT id, name from categories");
$stmt->execute();
    
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
      <h1>Add a Product</h1>
      <form action="add_product.php" method="post">
      <fieldset>
      <label for="name">
        Name: <input id="name" type="text" name="name"/><br>
      </label>
      
      <label for="price">
        Price:<input id="price" type="text" name="price"/><br>
      </label>
   
Category_id
   <select name="select">
<?php
    $row = $stmt->fetchAll();
        
    foreach ($row as $value){?>
                               
        <option value="<?php echo $value['id'];?>"><?php echo $value['id'];echo '->'; echo $value['name']; ?> </option>
     <?php }  ?>
           </select>

    
      <label>
      <input type="submit" value="Add product" name="add_product"/>
      </label>
      
      </fieldset>
      </form>
     </div>
      </body>
      </html>

 