<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--bootstrap css-->
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <!--jquery-->
    <script src="./vendor/jquery/jquery.min.js"></script>
   
    <!--popper js-->
    <!-- <script src="../proyecto/plugins/popper/popper.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/popper.min.js"></script>
   
    <!--bootstrap js-->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
   
    <!--datatables css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="../proyecto/plugins/DataTables/datatables.min.css"> -->
   
    <!--datatables js-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script> -->
    <script src="./vendor/DataTables/datatables.min.js"></script>
   
    <title>Lista de clientes</title>
    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">

    <!-- validador front -->
    <script src="./js/validateAlta.js"></script>
    <script src="./js/validateLogin.js"></script>
    <script src="./js/validateUpdate.js"></script>

    <!-- libreria para no usar los insufribles alert y prompt -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    
    <!--init datatables-->
    <script>
            $(document).ready(function(){
                $('#miTabla').DataTable();
            });
    </script>
  </head>
    