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

$conn = my_connect_db('localhost','root','123456',3306,'pool_php_rush');

$result = $conn->prepare("SELECT * from products");
$result->execute();

?> 
<!doctype html>
<html lang="fr">
    <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
    <body>
    <div class="logo"></div>
    <div class="login-block">
    <h1>Displaying Products</font></h1>    
    
    <table style="width:100%" border="1">
    <caption>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Category_id</th>
    </caption>
<?php while ($res = $result->fetch())
{
    ?>
    <tr>
<td><?php echo $res['id']; ?></td>
<td><?php echo $res['name']; ?></td>
<td><?php echo $res['price']; ?></td>
<td><?php echo $res['category_id']; ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>
