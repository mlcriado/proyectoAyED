<?php
session_start();

if($_SESSION['logueado'] == false) {
	header("Location:index.php");
}


//Abrir conección a DB
include("./includes/connection.php");
// $connect = mysqli_connect('localhost', 'root', 'mysql', 'edi2form') or die('Error Nro.: ' . mysqli_errno($connect) . 'No se pudo conectar a la DB: ' . mysqli_error($connect));

//Preparar consulta SQL
$sql = "SELECT p.id, p.dni, p.apyn, p.email, p.sexo, p.id_ocupacion, o.detalle AS ocupacion FROM personas AS p INNER JOIN ocupaciones AS o ON (p.id_ocupacion = o.id) ORDER BY apyn;";

//Ejecutar consulta union interna entre la tabla personas y ocupaciones
$res = mysqli_query($connect, $sql) or die("Error:" . mysqli_errno($connect) . "<br>" . mysqli_error($connect));


include("includes/headerForm.php");
?>
<!-- ...usar resultados -->
<body class="bg-dark text-white" background="./img/map-image.png">
<?php include("includes/navBar.php");?> 

<section>
		<h2 class="p-3">Listado de datos de todos nuestros clientes</h2>
		<table id="miTabla" class="container table table-striped table-dark p-3">
			<thead>
				<tr class="bg-success">
					<th scope="col"> # </th>
					<th scope="col"> DNI </th>
					<th scope="col"> Nombre y Apellido </th>
					<th scope="col"> Email </th>
					<th scope="col"> Sexo </th>
					<th scope="col"> Ocupacion </th>
					
				</tr>
			</thead>
			<tfoot>
			<tr class="bg-success">
					<th scope="col"> # </th>
					<th scope="col"> DNI </th>
					<th scope="col"> Nombre y Apellido </th>
					<th scope="col"> Email </th>
					<th scope="col"> Sexo </th>
					<th scope="col"> Ocupacion </th>
					
				</tr>
			</tfoot>
			<tbody>
				<?php
				$i = 0;
				
				while ($row = mysqli_fetch_assoc($res)) {
					$i++;
					if ($row['sexo'] == 'F') {
						$sexo = 'Femenino';
					} else {
						$sexo = 'Masculino';
					}
					// $dni = $row['dni'] ;
					
					echo "<tr>",
					"<td scope='row' > $i </td>",
					"<td scope='row' >" . $row['dni'] . "</td>",
					"<td scope='row' >" . $row['apyn'] . "</td>",
					"<td scope='row' >" . $row['email'] . "</td>",
					"<td scope='row' >" . $sexo . "</td>",
					"<td scope='row' >" . $row['ocupacion'] . "</td>",

					"</tr>";
				}
				// Cerrar conección a DB
				mysqli_close($connect);
				?>
			</tbody>
		</table>
	</section>
</body>

</html>