<!doctype html>
<html lang="fr">
      <head>
      <meta charset="utf-8">
      <title>Admin</title>
     <link rel="stylesheet" type="text/css" href="mystyle.css">
      </head>
      <body>
<div class="logo"></div>
<div class="login-block">
     <h1>ADMIN</h1>
      <form action="admin.php" method="post">
     <fieldset>
      
      <label for="creating a user">
        <input id="creating a user" type="submit" value="Create a user" name="create_user"/>
      </label>
      
      <label for="delete">
        <input id="delete" type="submit" value="Delete a user" name="delete_user"/>
      </label>
     
     <label for="edit">
     <input id="edit" type="submit" value="Edit user" name="edit_user"/>
      </label>

       <label for="display">
     <input id="display" type="submit" value="Display user" name="display_user"/>
      </label>

      <label for="add_product">
     <input id="add_product" type="submit" value="Add product" name="add_product"/>
      </label>

      <label for="delete_product">
     <input id="delete_product" type="submit" value="Delete product" name="delete_product"/>
      </label>

      <label for="edit_product">
     <input id="edit_product" type="submit" value="Edit product" name="edit_product"/>
      </label>

      <label for="display_product">
     <input id="display_product" type="submit" value="Display product" name="display_product"/>
      </label>


      <label for="create_category">
     <input id="create_category" type="submit" value="Create category" name="create_category"/>
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

$conn = my_connect_db('localhost','root','123456',3306,'pool_php_rush');

if(isset($_POST['create_user']) AND $_POST['create_user']=='Create a user')
    {
        header("Location: inscription.php");
    }

if(isset($_POST['delete_user']) AND $_POST['delete_user']=='Delete a user')
    {
        header("Location: delete_user.php");
    }

if(isset($_POST['edit_user']) AND $_POST['edit_user']=='Edit user')
    {
        header("Location: modify_account.php");
    }

if(isset($_POST['display_user']) AND $_POST['display_user']=='Display user')
    {
        header("Location: display_user.php");
    }

if(isset($_POST['add_product']) AND $_POST['add_product']=='Add product')
    {
        header("Location: add_product.php");
    }

if(isset($_POST['delete_product']) AND $_POST['delete_product']=='Delete product')
    {
        header("Location: delete_product.php");
    }

if(isset($_POST['edit_product']) AND $_POST['edit_product']=='Edit product')
    {
        header("Location: edit_product.php");
    }

if(isset($_POST['display_product']) AND $_POST['display_product']=='Display product')
    {
        header("Location: display_product.php");
    }

if(isset($_POST['create_category']) AND $_POST['create_category']=='Create category')
    {
        header("Location: create_category.php");
    }

?>