    <!doctype html>
    <html lang="fr">
          <head>
          <meta charset="utf-8">
          <title>Index</title>
          <link rel="stylesheet" type="text/css" href="mystyle.css">
          </head>
          <body>
    <?php
          session_start();
    if(isset($_COOKIE['name']) && (!empty($_COOKIE['name'])))
        {
            $_SESSION['name'] = $_COOKIE['name'];
        }    
          
    echo "Hello " .$_SESSION['name'];

    $name = $_SESSION['name'];

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

    $result = $conn->prepare("SELECT * from users WHERE username = '$name'");
    $result->execute();
    $res = $result->fetch();

    ?>
    <br>
    <div class="logo"></div>
    <div class="login-block">
         <h1>INDEX</h1>
    <form action="index.php" method="POST">
        <label for="logout">
        <input type="submit" value="logout" name="logout"/>
        </label>
    <?php if ($res['admin'] == 1 )
    {
       echo " <label for='admin'>
        <input type='submit' value='Admin' name='admin'/>
        </label>";
    }?>
        </form>
    <?php
       
    if ($_POST['logout'] == "logout")
        {
            session_unset();
            session_reset();
            session_destroy();               
            setcookie('name', null, -1, '/');
            header('Location: login.php');
        }

    if ($_POST['admin'] == "Admin")
        {
            header('Location: admin.php');
        }

    if (empty($_SESSION))
        header('Location: login.php');
    ?>
    </div>
     </body>
</html>
