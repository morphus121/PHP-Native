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

$conn=my_connect_db('localhost','root','123456',3306,'pool_php_rush');

$result = $conn->prepare("SELECT * from products");
$result->execute();

 
while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
             $na=$row['id'];
             $_SESSION[$na] = $row['name'];
             setcookie($na, $_SESSION[$na], time()+60*60*24*365, '/');
            
         
            echo(
	"<div \">".
		$row['id'].
		" ".
		$row['name'].
    	" ".
		$row['price'].
    	" ".
		$row['category_id'].

		"<a href=\"".$row['id']."\"".">"."<form action='edit2.php?name=" .$_SESSION[$na] ."' method='POST'><input type='submit' value='Edit'>
</input></form>"."</a>".
	"</div>".
	"\n"
) ;

        }
?>

<?php

if (isset($_POST['submit']))
    {
        header("Location: edit2.php");
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

      </body>
      </html>

