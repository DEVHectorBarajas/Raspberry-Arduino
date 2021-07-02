<?php
    $username = "root";
    $password = "password";
    $database = "optativa";
    $localhost = "localhost";

    $conn = new mysqli($localhost, $username, $password, $database);
    if($conn->connect_errno){
        echo "Failed to connect to MySQL " . $conn->connect_error;
        exit();
    }

    $query = "SELECT FECHA_HORA, T, HR, HRDOS, HRA FROM TBNodo2 t1 WHERE t1.HRA <> (SELECT t2.HRA FROM TBNodo2 t2 WHERE t2.id < t1.id ORDER BY t2.id DESC LIMIT 1) AND DATE(FECHA_HORA) >= DATE(CURDATE()) - INTERVAL 7 DAY OR t1.id = (SELECT MIN(id) FROM TBNodo2) AND DATE(FECHA_HORA) >= DATE(CURDATE()) - INTERVAL 7 DAY ORDER BY FECHA_HORA DESC";
    if($result = $conn->query($query)){
        
        if($result->num_rows > 0){
            $dateTemp = array();
            $index = 0;
            $data = array();
            $dataRH = array();
            $dataH = array();
            while($row = $result->fetch_array(MYSQLI_NUM)){
                $dateTemp[$index] = $row[0];
                $data[$index] = (float)$row[1];
                $dataRHNumerica[$index] = (float)$row[2];
                $dataRHDosNumerica[$index] = (float)$row[3];
                if((float)$row[2] <= 300){
                    (float)$row[2] = 25;
                }else if((float)$row[2] > 300 && (float)$row[2] < 350){
                    (float)$row[2] = 20;
                }else if((float)$row[2] > 350 && (float)$row[2] < 400){
                    (float)$row[2] = 15;
                }else if((float)$row[2] > 400 && (float)$row[2] < 450){
                    (float)$row[2] = 10;
                }else if((float)$row[2] > 450){
                    (float)$row[2] = 5;
                }else{
                    (float)$row[2] = 0;
                }

                if((float)$row[3] <= 300){
                    (float)$row[3] = 25;
                }else if((float)$row[3] > 300 && (float)$row[3] < 350){
                    (float)$row[3] = 20;
                }else if((float)$row[3] > 350 && (float)$row[3] < 400){
                    (float)$row[3] = 15;
                }else if((float)$row[3] > 400 && (float)$row[3] < 450){
                    (float)$row[3] = 10;
                }else if((float)$row[3] > 450){
                    (float)$row[2] = 5;
                }else{
                    (float)$row[2] = 0;
                }

                $dataRH[$index] = (float)$row[2];
                $dataRHDOS[$index] = (float)$row[3];
                $dataH[$index] = (float)$row[4];
                $index++;
            }
            $array = array(
                $dateTemp,
                $data,
                $dataRH,
                $dataRHDOS,
                $dataH,
                $dataRHNumerica,
                $dataRHDosNumerica
            );
            echo json_encode($array);
        }else{
            echo "0 results";
        }
    }
?>