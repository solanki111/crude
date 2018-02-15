<?php
/*
/* Database credentials. Assuming you are running MySQL server with default setting (user 'root' with no password) */
define('DB_SERVER', 'crudedbs.database.windows.net');
define('DB_USERNAME', 'rooter');
define('DB_PASSWORD', 'crude');
define('DB_NAME', 'Test1234');
 
/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
*/

/************************************************************************************************/
// PHP Data Objects(PDO) Sample Code:

try {
    $conn = new PDO("sqlsrv:server = tcp:crudedbs.database.windows.net,1433; Database = crudedb", "rooter", "{your_password_here}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "rooter@crudedbs", "pwd" => "{your_password_here}", "Database" => "crudedb", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:crudedbs.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>