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

        $query = "SELECT id FROM usuarios where email = '".$email."' and contrasena = '".$contrasena."'";
        if($result = $conn->query($query)){
            if($result->num_rows > 0){
                header("Location: http://192.168.0.250/dashboard/index.php");
            }else{
                echo "No se encontraró un usuario registrado con esos datos. <a href='login.php'>Volver</a>";
            }
        }else{
            echo "No se mandaron los datos completos. <a href='login.php'>Volver</a>";
        }
    }
?>