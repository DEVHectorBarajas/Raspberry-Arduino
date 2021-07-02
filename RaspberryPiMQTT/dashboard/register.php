<?php
  if($_POST['email'] && $_POST['contrasena']){
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $username = "root";
    $password = "password";
    $database = "optativa";
    $localhost = "localhost";

    $conn = new mysqli($localhost, $username, $password, $database);
    if($conn->connect_errno){
        echo "Failed to connect to MySQL " . $conn->connect_error;
        exit();
    }

    $query = "INSERT INTO usuarios (email, contrasena) VALUES ('".$email."', '".$contrasena."')";
    if ($conn->query($query) === TRUE) {
        echo "Usuario registrado. <a href='login.html'>Volver</a>";
      } else {
        echo "Error: " . $query . "<br>" . $conn->error;
      }
      
      $conn->close();      
  }else{
      echo "No se mandaron los datos completos <a href='register.php'>Volver</a>";
  }
?>