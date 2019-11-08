<?php
session_start();
include("../includes/connection.php");
include("../includes/headerForm.php");

// if ($_SESSION['logueado'] == false) {
//     header("Location: ../index.php");
// }

//Zona de validaciones
$flag = array("dni"=>"true", "apyn"=>"true", "email"=>"true", "sexo"=>"true", "hobbies"=>"true", "ocupacion"=>"true", "sugerencias"=>"true",);
$dni = trim($_POST['dni']);
    // $dnilength = strlen($dni);

    if (!is_numeric($dni)) {

        echo "ERROR: El dni solamente admite números"."<br>";
        $flag['dni'] = "false";

    } 
        else {
            
            
            $INTdni = intval($dni); 
            // $dni += $dni;
            
            if (is_int($INTdni)&&($INTdni>=4000000)&&($dni<=100000000)) {
            
                echo $dni."</br>";
                // $_SESSION['dni'] = $dni;

            }
            else {
                
                echo "ERROR: Dni con formato incorrecto"."</br>";
                echo "Por favor verifique que el campo no este vacio"."</br>";
                echo "Verifique la cantidad de caracteres"."</br>",
                "<br><a href='#' onclick='window.history.back();'>",
                "Volver </a>";
                $flag['dni'] = "false";

            }
        }
$apyn = trim($_POST['apyn']);
if (!empty($apyn)) {
                
    $apyn = strtoupper($apyn);
    echo $apyn."</br>";
   
    // $_SESSION['apyn'] = $apyn;
        
} else {
    echo "ERROR: Nombre y apellido con formato incorrecto"."</br>";
    echo "Por favor verifique que el campo no este vacio"."</br>";
    $flag['apyn'] = "false";

    }
           
$email = $_POST['email'];

if (empty($email)){
    
    $flag['email'] = "false";
    echo "ERROR: Email vacio o con formato incorrecto"."</br>";

    }else {

    echo $email."</br>";
    }


$sexo = $_POST['sexo'];
if (!isset($sexo)){
    // 
    $flag['sexo'] = "false";
    echo "ERROR: Debe seleccionar un sexo"."</br>";

    }
    else {
    echo $sexo."</br>";
    }    
   
$hobbies = $_POST['hobbies'];
$banner = "Elejiste la opcion";

if(empty($hobbies)){
    
    echo "ERROR: No seleccionaste ningun hobbie"."</br>";
    $flag['hobbies'] = "false";
    
} else {
    foreach($hobbies as $clave){
        // echo $valor."</br>";
        switch ($clave) {
            
            case '1':
            echo $banner."Musica"."</br>";
            break;
            
            case '2':
            echo $banner."Teatro"."</br>";
            break;
            
            case '3':
            echo $banner."Deporte"."</br>";
            break;
            
            case '4':
            echo $banner."Actividades al aire libre"."</br>";
            break;
            
            case '5':
            echo $banner."Videojuegos"."</br>";
            break;
            
            default:
            echo "ERROR: Debe seleccionar al menos un hobbie"."</br>";
            $flag['hobbies'] = "false";
            break;


        }
}


$id_ocupacion = $_POST['ocupacion'];
if (!isset($id_ocupacion)){
    // echo $_POST['sexo']."</br>";
    $flag['ocupacion'] = "false";
    echo "ERROR: Debe seleccionar una ocupacion"."</br>";

    }
    else {
        echo $id_ocupacion."</br>";
    }
 
$sugerencias = $_POST['sugerencias'];
if (!isset($sugerencias)){
    
    $flag['sugerencias'] = "false";
    echo "ERROR: Debe escribir una sugerencia"."</br>";

}
    else {
        echo $sugerencias."</br>";
    }
    
$esCorrecto = true;   
foreach ($flag as $clave => $valor) {
    if ($valor == "false") {
        $esCorrecto = false;
        break;
    }

}

if ($esCorrecto == false) {

    echo "Por favor, ingrese los datos correctamente.",
    "<br><a href='#' onclick='window.history.back();'>",
    "Volver </a>";

} else {

    $dni = addslashes($dni);
    $apyn = addslashes($apyn);
    $email = addslashes($email);
    $sexo = addslashes($sexo);
    $sugerencias = addslashes($sugerencias);
    

    $findFlag = true; // flag que me va a indicar si el registro ya existe o no en la DB
    
    //Nos conectamos a la DB
    // $connect = mysqli_connect('localhost', 'root', 'mysql', 'edi2form') or die('Error Nro.: ' . mysqli_errno($connect) . 'No se pudo conectar a la DB: ' . mysqli_error($connect));

    //Guardamos la consulta en la variable
    $sql = "SELECT * FROM personas WHERE dni = '$dni' AND sexo = '$sexo';";

    //Ejecutamos la consulta
    $res = mysqli_query($connect, $sql) or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect));

    if (mysqli_affected_rows($connect) > 0) {
        $findFlag = false;
        $row = mysqli_fetch_assoc($res);
       
        echo "Ya se encuentra un registro para: <br>",
            "dni: " . $row['dni'] . "<br>",
            "Sexo: ",
            ($sexo == 'F') ? "Femenino" : "Masculino", //<-- Sintaxis simplificada del IF
            "<br>",
            "Nombre: " . $row['apyn'] . "<br>",
           
            "<form class='container p-3 mb-2 bg-dark text-white rounded' action='../update/recibeDatos.php' method='POST'>",
            "<input type='hidden' name='dni' value='" . $row['dni'] . "'>",
            "<input type='hidden' name='apyn' value='" . $row['apyn'] . "'>",
            "<input type='submit' value=' MODIFICAR REGISTRO '><br>",
            "<input type='button' onclick='window.history.back()' value=' VOLVER '>&nbsp;&nbsp;",
            "</form>";
          
    }

    if ($esCorrecto && $findFlag) {
        //Preparar consulta SQL
        $sql   = "INSERT INTO personas (dni, apyn, email, sexo, id_ocupacion, sugerencias) VALUES ('$dni', '$apyn', '$email', '$sexo', $id_ocupacion, '$sugerencias')";
        //Ejecutar consulta
        $res    = mysqli_query($connect, $sql) or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect) . "SQL: " . $sql);

        //Una consulta del tipo INSERT devuelve true o false.
        if ($res) {
            
            $id_personas = mysqli_insert_id($connect); //Recupera el id del registro insertado previamente
            $guardoHobbie = true;

            //Isertar registros en tabla relacional
            foreach ($hobbies as $clave) {
                //Preparar consulta SQL (en este caso se pueden reutilizar las variables $sql y $res)
                $sql = "INSERT INTO personas_hobbies (id_personas, id_hobbies) VALUES ($id_personas, $clave)";
                //Ejecutar consulta
                $res = mysqli_query($connect, $sql) or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect) . "SQL: " . $sql);
                if (!$res) {
                    $guardoHobbie = false;
                }
            }
            if ($guardoHobbie) {
                echo "Se ha guardado el registro <br>",
                "<br><a href='../index.php'>Volver</a>";
            } else {
                
                
                echo "Parece que hubo un error, por favor, revise los datos ingresados<br>",
                "<form action='../update/recibeDatos.php' method='POST'>",
                "<input type='hidden' name='dni' value='" . $row['dni'] . "'>",
                "<input type='hidden' name='sexo' value='" . $row['apyn'] . "'>",
                "<input type='submit' value=' VER MÁS '><br>",
                "</form>";
            }
            
        } else {
            echo "Ocurrió un error, por favor, intentelo nuevamente <br>",
            "<br><a href='../index.php'>Volver</a>";
        }

    }
  }

}