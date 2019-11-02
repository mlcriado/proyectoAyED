<?php
session_start();

if($_SESSION['logueado'] == false) {
	header("Location:index.php");
}



include("includes/headerForm.php");
?>

<body class="bg-dark text-white" background="./img/map-image.png">
    
    <section>

        <div class="container rounded p-5">
        <h2 class="p-3"><strong>Formulario de busqueda</strong></h2>
            <form name="form2" action="./delete/borra.php" method="post" onsubmit="return ValidateSearch();">
                    <div class="form-group mx-sm-3">
                        <label for="dni">DNI</label>
                        <input type="text" class="form-control" name="dni" id="dni" placeholder="ej 32874906">
                    </div>
                    <div class="form-group mx-sm-3">
                        <label for="apyn">Nombre y Apellido</label><br>
                        <input id=apyn type="text" class="form-control" name="apyn" placeholder="Sanchez" minlength=”4” maxlength="80">
                    </div>
                    <button type="submit" class="ml-3 btn btn-success">Buscar</button>
            </form>
            
        </div>
    </section>
    <script>

    function ValidateSearch() {

        dni = document.getElementById("dni").value;
        if (dni == "") {
            
            // alert("Debe completar el DNI");
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Debe completar el DNI',
                
            })
            return false;
            
        }
        
        else if (dni.length < 8) {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'El DNI debe contener 8 dígitos y debe contener solo numeros',
                
            })
            return false;
        }
        apyn = document.getElementById("apyn").value;
        
        if (apyn == "") {
            // alert("Debe completar su Nombre y Apellido");
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Debe completar el Apellido para la busqueda',
					
				  })
				return false;
			}
            
        

    }


    </script>
    </body>
</html>
            
           
                
