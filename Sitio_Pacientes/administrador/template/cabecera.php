<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--link rel="stylesheet" href="../seccion/productos.css"-->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
  </head>
  <body>

    <?php $url="http://".$_SERVER['HTTP_HOST']."/Sitio Web";?>


    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador del sitio web<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url."/administrador//";?>">Incio</a>
                                              <!-- aqui redireccionamos a la pagina de inicio de administrador -->

            <a class="nav-item nav-link" href="<?php echo $url."/administrador/seccion/productos.php";?>">Documentos</a>
            <a class="nav-item nav-link" href="<?php echo $url."/administrador/seccion/cerrar.php";?>">Cerrar</a>


            <a class="nav-item nav-link" href= "<?php echo $url;?>">Ver sitio web</a>
        </div>
    </nav>


    <div class="container">
    <br/>
        <div class="row">