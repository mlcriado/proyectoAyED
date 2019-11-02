<?php
session_start();

include("./includes/connection.php");
$email = $_POST['email'];
$pass = $_POST['pass'];


    if (isset($email)) {

        
        // $email = addslashes($email); 
        //Nos conectamos a la base
        // $connect = mysqli_connect('localhost', 'root', 'mysql', 'edi2form') or die('Error Nro.: ' . mysqli_errno($connect) . 'No se pudo conectar a la DB: ' . mysqli_error($connect));

        $query = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1;";
        //resultado de la query
        $res = mysqli_query($connect, $query) or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect));
        
        if (mysqli_affected_rows($connect) < 1) {

            echo "No se encuentra registrado en nuestra Base de Datos <br>",
            "<a href='#' onclick='window.history.back()'>Volver</a>";
            
        } else {

            $row = mysqli_fetch_assoc($res);
            echo $row['email'];
            echo $row['clave'];
            if ($row['email'] == $email && $row['clave'] == $pass) {
                $_SESSION['logueado'] = true;
                $_SESSION['usuario'] = $row['usuario'];
                header("Location: ./index.php");
            } else {
                echo "Error en el Email o Contraseña <br>",
                "<a href='#' onclick='window.history.back()'>Volver</a>";
            }
        }
        //Cerrarmos la conección a la base
        mysqli_close($connect);
        
    } else {
        echo "ERROR: Email vacio o con formato incorrecto"."</br>",

        "<a href='#' onclick='window.history.back()'>Volver</a>";        
    
    }
    
    
    
