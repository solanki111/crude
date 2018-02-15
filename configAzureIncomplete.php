<?php
/*

// Attempt to connect to MySQL database
$connectstr_dbhost = 'crudedbs.database.windows.net';
$connectstr_dbname = 'crudedb';
$connectstr_dbusername = 'rooter';
$connectstr_dbpassword = 'Test1234';


// MS Azure does not allow direct access to MySQL configuration, only via environment
foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }
    
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

$pdo = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);

if (!$pdo) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

*/
// TODO make sure DB exists

// TODO create table (only once, if it does not yet exist)

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