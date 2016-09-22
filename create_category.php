 <?php

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


if(isset($_POST['add_category']) AND $_POST['add_category']=='Add category')
{
    $conex = my_connect_db('localhost','root','123456',3306,'pool_php_rush');
    $stmt = $conex->prepare("INSERT INTO categories (name, parent_id) VALUES (:name, :parent_id)");
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':parent_id', $_POST['selectname']);
    $stmt->execute();
}

$conn = my_connect_db('localhost','root','123456',3306,'pool_php_rush');
$stmt = $conn->prepare("SELECT name, id from categories where id < 5");
$stmt->execute();

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
      <h1>Add a Category</h1>


            
      <form action="create_category.php" method="post">
    
      <label for="name">
        Name: <input id="name" type="text" name="name"/><br>
      </label>
            
   <select name="selectname">
<?php
    $row = $stmt->fetchAll();
        
    foreach ($row as $value){?>
                               
            <option value="<?php echo $value['id'];?>"><?php echo $value['name']; ?> </option>
     <?php }  ?>
           </select>
</br>
        <label>
        <input type="submit" value="Add category" name="add_category"/>
        </label>
        
        
        </form>
        </div>
        </body>
        </html>

     