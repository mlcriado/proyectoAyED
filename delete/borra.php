<?php 
session_start();
// if ($_SESSION['logueado'] == false) {
    
//     header("Location: ./index.php");
// }
// Conección a DB
include("../includes/connection.php");

$dni = $_POST['dni'];
$apyn = $_POST['apyn'];
$deleteFlag=true;


$dni = trim($_POST['dni']);
    // $dnilength = strlen($dni);

    if (!is_numeric($dni)) {

        echo "ERROR: El dni solamente admite números"."<br>";
        $deleteFlag=false;
    } 
        else {
            
            
            $intdni = intval($dni); 
            // $dni += $dni;

            if (is_int($intdni)&&($intdni>=499999)&&($intdni<=100000000)) {
            
                echo $intdni."</br>";
                $_SESSION['intdni'] = $intdni;
            
            }
                else {
                
                echo "ERROR: dni con formato incorrecto"."</br>";
                echo "Por favor verifique que el campo no este vacio"."</br>";
                echo "Verifique la cantidad de caracteres"."</br>";
                $deleteFlag=false;

                }
        }

$apyn = trim($_POST['apyn']);
if (!empty($apyn)) {
        
    $apyn = strtoupper($apyn);
    echo $apyn."</br>";
        
} else {
        
        echo "ERROR: Nombre y apellido con formato incorrecto"."</br>";
        echo "Por favor verifique que el campo no este vacio"."</br>";
        $deleteFlag=false;

    } 
if ($deleteFlag) {

    $sql = "DELETE FROM personas WHERE dni = '$intdni' AND apyn = '$apyn';";
//Ejecutar consulta
    $res = mysqli_query($connect, $sql) or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect));

    if ($res){
    
        echo "Se han borrado los datos de DNI: ".$dni." - Apellido: ".$apyn." ";
 
    } else {
    echo "Ocurrió un error, por favor, intentelo nuevamente";
    } 
    echo "<br><a href='../index.php'>Volver</a>";
}

?>