<?php 
session_start();
include("includes/connection.php");
include("includes/headerForm.php");

if ($_SESSION['logueado'] == false) {

    header("Location: ./index.php");
}
// Conección a DB
// $connect= mysqli_connect('localhost', 'root', 'mysql', 'edi2form') or die('Error Nro.: ' . mysqli_errno($connect) . 'No se pudo conectar a la DB: ' . mysqli_error($connect));

//Consulta/s SQL
$consultaH = "SELECT * FROM hobbies";
$consultaO = "SELECT * FROM ocupaciones";

//Resultado de ejecutar la consulta en la tabla hobbies
$resultH = mysqli_query($connect, $consultaH) or die("Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect));

//Resultado de ejecutar la consulta en la tabla ocupaciones
$resultO = mysqli_query($connect, $consultaO) or die("Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect));

mysqli_close($connect);
?>

<body class="bg-dark text-white" background="./img/map-image.png">
     <header>
        <div class="container pt-5">
            <h1><strong>Formul&aacute;rio de Registro para Formulario para <?php echo $_SESSION['usuario']; ?></strong></h1>
        </div>
    </header>    
    <section>
        <div class="container p-3 mb-2 text-white rounded">
            <!-- <div>
                <h2>Formulario de Inscripcion</h2>
            </div> -->
                <form name="form1" action="create/guarda.php" method="post" onsubmit="return ValidateAlta();">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="dni">DNI</label><br>
                            <input type="text" class="form-control" name="dni" id="dni" placeholder="ej 32874906">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apyn">Nombre y Apellido</label><br>
                            <input id=apyn type="text" class="form-control" name="apyn" placeholder="" minlength=”4” maxlength="80">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Email address</label><br>
                            <input id="email" type="email" class="form-control" name="email" placeholder="name@email.com" maxlength="80">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group col-md-6">

                            <label for="sexo">Sexo</label><br>
                            <input type="radio" name="sexo" value="f"><span>Femenino</span>
                            <input type="radio" name="sexo" value="m"><span>Masculino</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="hobbies">Hobbies</label><br>
                            <?php
				            //Cargar los hobbies desde la base de datos 
				            while ($row = mysqli_fetch_assoc($resultH)) {
					            echo "<input type='checkbox' name='hobbies[]' value='$row[id]'>",
						        "<span class='chekLabel'>",
						        ucfirst(strtolower($row['detalle'])),
                                "</span>";
                                //ucfirst = UpperCase first
                                //strlower = String lowercase
			            	}
				            ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ocupacion">Ocupacion</label><br>
                            <select name="ocupacion" id="ocp" class="custom-select">
                                <option value="0" disabled>--Seleccione--</option>
                                <?php
					                while ($row = mysqli_fetch_assoc($resultO)) {
					                    	echo "<option value='$row[id]'>",
						                    ucfirst(strtolower($row['detalle'])),
                                            "</option>";
                                            
					                }
					            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sugerencias" class="col-md-2 col-form-label">Sugerencias</label>
                        <div class="col-sm-10">
                            <textarea id ="sugerencias" name="sugerencias" rows="3" placeholder="ingrese sus comentarios o sugerencias" class="form-control" maxlength="250" ></textarea><br>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="button" class="btn btn-danger" name="cancelar" onclick="window.location.href='./index.php'" value="Cancelar">
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
        
        
    
    
    
    
    
    
    
    
    
    
    
    
                    

                
                        
                              
                    
                   
                                   
                

                                            
                                            
                                            
                                            
                                            
                                            
                                        



