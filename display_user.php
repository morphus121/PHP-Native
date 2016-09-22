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

$name = $_SESSION['name'];
$conn = my_connect_db('localhost','root','123456',3306,'pool_php_rush');

$result = $conn->prepare("SELECT * from users where username = '$name'");
$result->execute();
$res = $result->fetch();

if ($res != false) 
    {
        $id = $res['id'];
        $name = $res['username'];
        $password = $res['password'];
        $email = $res['email'];
        // $admin = $res['admin'];                    
    }
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
    <h1>Displaying user <font color="blue"><?php echo $name; ?></font></h1>    
    
    <table style="width:100%" border="1">
    <caption></caption>
<tr>
<th>ID</th>
<th>Username</th>
<th>Password</th>
<th>Email</th>
</tr>

<td><?php echo $id; ?></td>
<td><?php echo $name; ?></td>
<td><?php echo $password; ?></td>
<td><?php echo $email; ?></td>

</tr>
</table>
</body>
</html>
