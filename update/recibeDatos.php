<?php
session_start();
include ("../includes/connection.php");
include ("../includes/headerForm.php");

$dni = $_POST['dni'];
$apyn = $_POST['apyn'];
// $modFlag=true;
$dni = trim($_POST['dni']);
// $dnilength = strlen($dni);

if (!is_numeric($dni)) {
    
    
    echo "<script language='javascript'>
    Swal.fire({
        type: 'error',
        title: 'Error en el DNI',
        text: 'El dni solamente admite números',
        
    }).then(function() {
        window.location = '../index.php';
    });
    </script>";
    exit();
    
    
    echo "ERROR: El dni solamente admite números"."<br>",
        "<input type='button' class='btn btn-danger' name='cancelar' onclick='window.location.href='../index.php'' value='Cancelar'>";

    // $modFlag=false;
} 
else {
    
    
    $intdni = intval($dni); 
    // $dni += $dni;
    
    if (is_int($intdni)&&($intdni>=499999)&&($intdni<=100000000)) {
        
        echo $intdni."</br>";
        // $_SESSION['intdni'] = $intdni;
        $apyn = trim($_POST['apyn']);
        
        if (!empty($apyn)) {
            
            $apyn = strtoupper($apyn);
            echo $apyn."</br>";
            
        } else {
            
            echo "<script language='javascript'>
            Swal.fire({
                type: 'error',
                title: 'Error en el Nombre y Apellido',
                text: 'Por favor verifique que el campo no este vacio',
                
            }).then(function() {
                window.location = '../index.php';
            });
            </script>";
            exit();
            
            // echo "ERROR: Nombre y apellido con formato incorrecto"."</br>";
            // echo "Por favor verifique que el campo no este vacio"."</br>",
            // "<a href='../index.php'>Volver</a>";
            // $modFlag=false;
        }
        
        
    }
    else {
        
        echo "<script language='javascript'>
        Swal.fire({
            type: 'error',
            title: 'ERROR: dni con formato incorrecto',
            text: 'Por favor verifique que el campo no este vacio'.'</br>',
            'Verifique la cantidad de caracteres'.'</br>',  
            
        }).then(function() {
            window.location = '../index.php';
        });
        </script>";
        exit();
        
        
        // echo "ERROR: dni con formato incorrecto"."</br>";
        // echo "Por favor verifique que el campo no este vacio"."</br>";
        // echo "Verifique la cantidad de caracteres"."</br>",
        // "<a href='../index.php'>Volver</a>";   
        // $modFlag=false;
        
    }
    
    
} 
//union interna de las tablas personas y ocupaciones
$sql_union_o = "SELECT * FROM personas AS p INNER JOIN ocupaciones AS o ON (p.id_ocupacion=o.id) WHERE dni='$intdni' AND apyn = '$apyn';";
//Ejecutar consulta
$resO = mysqli_query($connect, $sql_union_o) or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect) . "SQL: " . $sql_union_o);
//Carga la tupla en un array asociativo
$row = mysqli_fetch_assoc($resO);

$sql="SELECT * FROM personas WHERE dni='$intdni' AND apyn = '$apyn';";
$res= mysqli_query($connect, $sql) or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect) . "SQL: " . $sql);
$tupla=mysqli_fetch_assoc($res);
$id_persona = $tupla['id'];
echo $id_persona."<br>";


$sqlH ="SELECT * FROM personas_hobbies WHERE id_personas='$id_persona'";
$resH = mysqli_query($connect, $sqlH) or die("Codigo de Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect) . "SQL: " . $sqlH);

while ($tuplaH = mysqli_fetch_assoc($resH)) {
    # code...
    $idHobbiesArray[]=$tuplaH['id_hobbies'];
   
}

echo $idHobbiesArray[0]."<br>";
echo $idHobbiesArray[1]."<br>";
echo $idHobbiesArray[2]."<br>";

//union interna de las tablas personas y hobbies
//$sql_union_h = "SELECT * FROM personas as p INNER JOIN personas_hobbies as ph on (p.id=ph.id_personas) INNER JOIN hobbies as h on (ph.id_hobbies=h.id) WHERE dni='$intdni' AND apyn = '$apyn';"; 

//para traer todas los hobbies y que aparezcan en el form
$consultaH = "SELECT * FROM hobbies";
//Resultado de ejecutar la consulta en la tabla hobbies
$resultH = mysqli_query($connect, $consultaH) or die("Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect));

//para traer todas los hobbies y que aparezcan en el form
$consultaO = "SELECT * FROM ocupaciones";
//Resultado de ejecutar la consulta en la tabla ocupaciones 
$resultO = mysqli_query($connect, $consultaO) or die("Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect));

if (!$row['dni']) {
    
    echo "
    <script language='javascript'>
    Swal.fire({
        type: 'warning',
        title: 'No estas en nuestra base de datos',
        text: 'Puede darse de alta si lo desea',
        
    }).then(function() {
        window.location = '../index.php';
    });
    </script>";
    exit();
    
}
?>   
<body class="bg-dark text-white" background="../img/map-image.png">
     <!--  -->
    <section>
        <div class="container p-3 mb-2 text-white rounded">
            <div>
                <h2><strong>Formul&aacute;rio de Modificacion para Formulario para <?php echo $row['apyn'] ?></strong></h2>
            </div>
                <form name="form3" action="./modifica.php" method="post" onsubmit="return ValidateUpdate();">
                    <input type='hidden' name='idPersona' value="<?echo $id_persona?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="dni">DNI</label><br>
                            <input type="text" class="form-control" name="dni" id="dni" value="<?php echo $row['dni']?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apyn">Nombre y Apellido</label><br>
                            <input id=apyn type="text" class="form-control" name="apyn" value="<?php echo $row['apyn']?>" minlength=”4” maxlength="80">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label><br>
                            <input id="email" type="email" class="form-control" name="email" value="<?php echo $row['email']?>" maxlength="80">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group col-md-6">

                            <label for="sexo">Sexo</label><br>
                            <input type="radio" name="sexo" value="F" <?php if ($row['sexo']== 'F') {
                                echo "checked";
                            }?>><span>Femenino</span>
                            <input type="radio" name="sexo" value="M" <?php if ($row['sexo']== 'M') {
                                echo "checked";
                            }?>><span>Masculino</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="hobbies">Hobbies</label><br>
                            <?php
                            //Cargar los hobbies desde la base de datos
				            while ($rowH = mysqli_fetch_assoc($resultH)) {

                                $checked="";
                                // ($rowH['id']=$tuplaH['id_hobbies']) ? $checked="checked" : $checked="";
                                if (($rowH['id']==$idHobbiesArray[0])||($rowH['id']==$idHobbiesArray[1])||($rowH['id']==$idHobbiesArray[2])) {

                                    $checked="checked";
                                    
                                }
                                # recorro el areglo de hobbies para ver si hay coincidencia con el hobbie actual
					            echo "<input type='checkbox' name='hobbies[]' value='$rowH[id]' $checked>",
						        "<span class='chekLabel'>",
						        ucfirst(strtolower($rowH['detalle'])),
                                "</span>";
                                //ucfirst = UpperCase first
                                //strlower = String lowercase
                            }         
				            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ocupacion">Ocupacion</label><br>
                            <select name="ocupacion" id="ocp" class="custom-select">
                                <option value="<?php echo $row['id_ocupacion']?>"><?php echo $row['detalle']?></option>
                                <?php
					                while ($rowO = mysqli_fetch_assoc($resultO)) {
					                    	echo "<option value='$rowO[id]'>",
						                    ucfirst(strtolower($rowO['detalle'])),
                                            "</option>";
                                            
					                }
					            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sugerencias" class="col-md-2 col-form-label">Sugerencias</label>
                        <div class="col-sm-10">
                            <textarea id ="sugerencias" name="sugerencias" rows="3" value="<?php echo $row['sugerencias']?>" class="form-control" maxlength="250" ></textarea><br>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="button" class="btn btn-danger" name="cancelar" onclick="window.location.href='../index.php'" value="Cancelar">
                        </div>       
                        <div class="form-group col-md-6">
                            <input type="submit" class="btn btn-success" name="enviar" value="Registrar">
                        </div>

                    </div>

                </form>
            </div>
        </body>                     
    </body>
</html>
