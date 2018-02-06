<?php

try {
    // create the database
    $sql = "CREATE DATABASE IF NOT EXISTS musicDB";
    $conn->exec($sql);
    
    // switch to the database
    $sql = "use musicDB";
    $conn->exec($sql);
    
    // create its table
    $sql = "CREATE TABLE IF NOT EXISTS employees (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(100) NOT NULL,
                address VARCHAR(255) NOT NULL,
                salary INT(10) NOT NULL);";
    $conn->exec($sql);
    echo "DB created successfully";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

?>