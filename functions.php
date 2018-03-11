<?php

//load the database configuration file
include 'config.php';

 // if (isset($_REQUEST['upload'])) {
  if(isset($_POST["Import"])){
    $ok = true;
    $file = $_FILES["file"]["tmp_name"];	
    $csvFile = fopen($file, "r");
    
//skip first line
    fgetcsv($csvFile);
    
    if ($file == NULL) {
      error(_('Please select a file to import'));
    }
    else {
      while(($filesop = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
          $name = trim($filesop[0]);
          $address = trim($filesop[1]);
          $salary = trim($filesop[2]);
          $email = trim($filesop[3]);
          
        // Validate name
        if(empty($name)){
            $ok = false;
            echo "<script type=\"text/javascript\">
                    alert(\"Please enter a name.\");
                    window.location = \"view.php\"
		</script>";
        } elseif(!strlen($name) && preg_match("/^[a-zA-Z'-.\s ]+$/", $name) > 0){
            $ok = false;
            echo "<script type=\"text/javascript\">
                    alert(\"Please enter a valid name.\");
                    window.location = \"view.php\"
		</script>";
        }

        // Validate address
        if(empty($address)){
            $ok = false;
            echo "<script type=\"text/javascript\">
                    alert(\"Please enter an address.\");
                    window.location = \"view.php\"
		</script>";
        }

        // Validate salary
        if(empty($salary)){
            $ok = false;
            echo "<script type=\"text/javascript\">
                    alert(\"Please enter the salary amount.\");
                    window.location = \"view.php\"
		</script>";
        } elseif(!ctype_digit($salary)){
            $ok = false;
            echo "<script type=\"text/javascript\">
                    alert(\"Please enter a positive integer value.\");
                    window.location = \"view.php\"
		</script>";
        }
        // example error handling. We can add more as required for the database.
        if (! (strlen($email) > 0 && preg_match("/^[a-z0-9._+-]{1,64}@(?:[a-z0-9-]{1,63}\.){1,125}[a-z]{2,63}$/", $email))) {
            $ok = false;
            echo "<script type=\"text/javascript\">
                    alert(\"E-mail address is not valid.\");
                    window.location = \"view.php\"
		</script>";
        }
        
        // If the tests pass we can insert it into the database.       
            if ($ok) {
                   $query = "INSERT INTO employeeinfo (name, address, salary, email) VALUES (:name, :address, :salary, :email)";  
             
              if($stmt = $pdo->prepare($query)){
                  // Bind variables to the prepared statement as parameters
                  $stmt->bindParam(':name', $param_name);
                  $stmt->bindParam(':address', $param_address);
                  $stmt->bindParam(':salary', $param_salary);
                  $stmt->bindParam(':email', $param_email);

                  // Set parameters
                  $param_name = $name;
                  $param_address = $address;
                  $param_salary = $salary;
                  $param_email = $email;

                  // Attempt to execute the prepared statement
                  if(!$stmt->execute()){
                      echo "Something went wrong. Please try again later.";
                  }
              }
                //Close statement
                unset($stmt);
            } 
        }
        echo "<script type=\"text/javascript\">
		alert(\"CSV File has been successfully Imported.\");
		window.location = \"view.php\"
            </script>";
        
        //close opened csv file
        fclose($csvFile);
    }
}

 if(isset($_POST["Export"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID', 'Name', 'Address', 'Salary', 'Email'));  
      $sql = "SELECT * from employeeinfo";  

      if($result = $pdo->query($sql)) {
          if($result->rowCount() > 0){
             while($row = $result->fetch()){
                 fputcsv($output, $row);  
            }  
          }
      } else {
              echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
      }
      fclose($output);  
 } 

?>
