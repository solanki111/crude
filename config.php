<?php

/* Attempt to connect to MySQL database */
$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';

foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }
    
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

echo "dbhost = $connectstr_dbhost" . PHP_EOL;
echo "dbname = $connectstr_dbname" . PHP_EOL;
echo "username = $connectstr_dbusername" . PHP_EOL;
echo "password = $connectstr_dbpassword" . PHP_EOL;

$pdo = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);

if (!$pdo) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

/*try {
    // create the database
    $sql = "CREATE DATABASE IF NOT EXISTS $connectstr_dbname";
    $pdo->exec($sql);
    
    // switch to the database
    $sql = "use $connectstr_dbname";
    $pdo->exec($sql);
    
    // create its table
    $sql = "CREATE TABLE IF NOT EXISTS employees (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(100) NOT NULL,
                address VARCHAR(255) NOT NULL,
                salary INT(10) NOT NULL);";
    $pdo->exec($sql);
    echo "DB created successfully";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}*/

?>