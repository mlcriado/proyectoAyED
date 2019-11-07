<?php
session_start();
include("../includes/connection.php");
include("../includes/headerForm.php");

// if ($_SESSION['logueado'] == false) {
//     header("Location: ../index.php");
// }

//Zona de validaciones
$idPersona=$_POST['idPersona'];
echo $idPersona."</br>";
if (!isset($idPersona)) {
    
    echo"<script language='javascript'>
        alert('tus datos no se modificaron')
        window.location='index.php'
        </script>";
        exit();

}


$flag = array("dni"=>"true", "apyn"=>"true", "email"=>"true", "sexo"=>"true", "hobbies"=>"true", "ocupacion"=>"true", "sugerencias"=>"true",);
$dni = trim($_POST['dni']);
    // $dnilength = strlen($dni);

    if (!is_numeric($dni)) {

        
        echo "ERROR: El dni solamente admite números"."<br>",
        $flag['dni'] = "false";
        

    } 
        else {
            
            $INTdni = intval($dni); 
            // $dni += $dni;
            if (is_int($INTdni)&&($INTdni>=499999)&&($dni<=100000000)) {
            
                echo $INTdni."</br>";
                // $_SESSION['dni'] = $dni;

            } else {
                
                $flag['dni'] = "false";
                echo "ERROR: Dni con formato incorrecto"."</br>";
                echo "Por favor verifique que el campo no este vacio"."</br>";
                echo "Verifique la cantidad de caracteres"."</br>";
            }
        }
                

$apyn = trim($_POST['apyn']); //sacamos espacios vacios al inicio y al final
if (!empty($apyn)) {
                
    $apyn = strtoupper($apyn); //pasamos el string a mayusculas
    //echo $apyn."</br>";
   
    // $_SESSION['apyn'] = $apyn;
        
} else {

   
    $flag['apyn'] = "false";
    echo "ERROR: Nombre y apellido con formato incorrecto"."</br>",
     "Por favor verifique que el campo no este vacio"."</br>";

}
           
$email = $_POST['email'];

if (empty($email)){
    
    $flag['email'] = "false";
    echo "ERROR: Email vacio o con formato incorrecto"."</br>";

}/* else {

    echo $email."</br>";
} */


$sexo = $_POST['sexo'];
if (!isset($sexo)){
     
    $flag['sexo'] = "false";
    echo "ERROR: Debe seleccionar un sexo"."</br>";

}
   /*  else {
    echo $sexo."</br>";
    }  */   
   
$hobbies = $_POST['hobbies'];
// $banner = "Elejiste la opcion";

if(empty($hobbies)){
    
    echo "ERROR: No seleccionaste ningun hobbie"."</br>";
    $flag['hobbies'] = "false";

} /* else {
    foreach($hobbies as $clave){
        // echo $valor."</br>";
        switch ($clave) {

            case '1':
                echo $banner."Musica"."</br>";
                break;

            case '2':
                echo $banner."Musica"."</br>";
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
            break;
                


        }
    }

} */
$id_ocupacion = $_POST['ocupacion'];
if (!isset($id_ocupacion)){
    // echo $_POST['sexo']."</br>";
    $flag['ocupacion'] = "false";
    echo "ERROR: Debe seleccionar una ocupacion"."</br>";

    }
    /* else {
        echo $id_ocupacion."</br>";
    } */
 
$sugerencias = $_POST['sugerencias'];
if (!isset($sugerencias)){
    
    $flag['sugerencias'] = "false";
    echo "ERROR: Debe escribir una sugerencia"."</br>";

}
   /*  else {
        echo $sugerencias."</br>";
    } */
    
$esCorrecto = true;   
foreach ($flag as $clave => $valor) {
    if ($valor == "false") {
        $esCorrecto = false;
        break;
    }

}

if ($esCorrecto == false) {

    echo "Por favor, ingrese los datos correctamente.",
    "<input type='button' class='btn btn-danger' name='cancelar' onclick='window.location.href='../index.php'' value='Volver'>";
   

} else {

    // $dni = addslashes($INTdni);
    echo $dni."</br>";
    // $apyn = addslashes($apyn);
    echo $apyn."</br>";
    //$email = addslashes($email);
    echo $email."</br>";
    //$sexo = addslashes($sexo);
    echo $sexo."</br>";
    echo $id_ocupacion."</br>";
    //$sugerencias = addslashes($sugerencias);
    echo $sugerencias."</br>";

    //$update_sql = "UPDATE personas SET (dni, apyn, email, sexo, id_ocupacion, sugerencias) VALUES ($INTdni, $apyn, $email, $sexo, $id_ocupacion, $sugerencias) WHERE (dni=$INTdni AND apyn=$apyn)";
    
    $update_sql ="UPDATE personas SET dni='$dni',apyn='$apyn',email='$email',sexo='$sexo',id_ocupacion=$id_ocupacion,sugerencias='$sugerencias' WHERE id=$idPersona";
    
    //Ejecutamos la consulta
    $res_update=mysqli_query($connect,$update_sql)or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect) . "SQL: " . $update_sql);
    
    //mysqli_affected_rows() trae el número de filas afectadas por la última consulta INSERT, UPDATE, o DELETE asociada con el identificador_de_enlace dado
   if (mysqli_affected_rows($connect) > 0) {

        $guardoHobbie = true;
        $deleteHobbies= "DELETE FROM personas_hobbies WHERE id_personas='$idPersona'";
        $res_deleteHobbies =mysqli_query($connect,$deleteHobbies)or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect) . "SQL: " . $deleteHobbies);
        foreach ($hobbies as $clave => $valor) {

            $insertHobbies = "INSERT INTO personas_hobbies (id_personas, id_hobbies) VALUES ($idPersona, $valor)";
            $res_insertHobbies=mysqli_query($connect,$insertHobbies)or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect) . "SQL: " . $insertHobbies);

            if (!$res_insertHobbies) {
                $guardoHobbie = false;

            }
        }

        if ($guardoHobbie) {
            echo "Se ha guardado el registro <br>",
            "<a href='../nuevo.php'>Volver</a>";
        } else {

            echo"<script language='javascript'>
            alert('no se pudo guardar la modificación')
                window.location='../buscarM.php'
                </script>";
        
        }
    } 

}  