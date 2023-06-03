<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitio Web</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <ul class="nav navbar-nav">

            <li class="nav-item ">
                <a class="nav-link" href="#">Portal Pacientes</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php">Inicio</a>
            </li>

            <li>
                <a class="nav-link" href="productos.php">Documentos</a>
            </li>

            <li>
                <a class="nav-link" href="nosotros.php">Nosotros</a>
            </li>

            <li>
                <?php
                //aqui se hara la condicion de que si se entra como adiministrador se habilitará en la navbar el boton de administracion de los documentos
                    /*if(){

                    }
                    */
                ?>
                <a class="nav-link" href="administrador\"> admin </a>
            </li>
        </ul>
    </nav>

    <div class="container">
    <br>
        <div class="row">