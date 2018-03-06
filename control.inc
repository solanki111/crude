<?php
  session_start();

  if(!(isset($_SESSION["is_login"]) && $_SESSION["login"] == "OK")) {
    header("Location: index.php");
    exit;
}
?>