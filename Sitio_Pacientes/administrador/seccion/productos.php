<?php include("../template/cabecera.php");?>

<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
/*
condicion ternaria (lo que se va a validar)? : lo que pasara si no se cumple
*/
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");

switch($accion){
   case "Agregar":
        //INSERT INTO `documentos` (`id`, `nombre`, `imagen`) VALUES (NULL, 'libro de php', 'imagen.jpg');
        $sentenciaSQL = $conexion->prepare("INSERT INTO `documentos` (`nombre`, `tipo`) VALUES (:nombre, :imagen);");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        //generacion de instruccion de subida
        $fecha=new DateTime();
        $nombreArchivo=($txtImagen != "")?$fecha->getTimestamp()."_".$_FILES['txtImagen']["name"]:"imagenDefecto.jpg";
        // si hay una fotografia tomamos la hora
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        // luego almacenamos la hora y adjuntamos imagenes temporales 

        if($tmpImagen != ""){
            //si la imagen esta ocupada o tiene algo es distinto de vacio
            move_uploaded_file($tmpImagen, "../../files/".$nombreArchivo);
            //la movemos a la carpeta img con el nombre del archivo
        }
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);

        $sentenciaSQL->execute();
        
        break; 

    case "Modificar":
        $sentenciaSQL= $conexion->prepare("UPDATE documentos SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(":nombre",$txtNombre);
        $sentenciaSQL->bindParam(":id",$txtID);
        $sentenciaSQL->execute();

        if($txtImagen =! ""){

            $fecha=new DateTime();
            $nombreArchivo=($txtImagen != "")?$fecha->getTimestamp()."_".$_FILES['txtImagen']["name"]:"imagenDefecto.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../files/".$nombreArchivo);

            $sentenciaSQL= $conexion->prepare("SELECT tipo FROM documentos WHERE id=:id");
            $sentenciaSQL->bindParam(":id",$txtID);
            $sentenciaSQL->execute();
            $Documento=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if(isset($Documento["tipo"]) && ($Documento["tipo"] != "imagenPorDefecto.jpg")){
                if(file_exists("../../files/".$Documento["tipo"])){
                    unlink("../../files/".$Documento["tipo"]);
                }
            }
            
            $sentenciaSQL= $conexion->prepare("UPDATE documentos SET tipo=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(":imagen",$nombreArchivo);
            $sentenciaSQL->bindParam(":id",$txtID);
            $sentenciaSQL->execute();
        }
                
        break;
    case "Cancelar":
        header("Location:productos.php");
        break;
    
    case "Seleccionar":
        // echo "Seleccionó";
        $sentenciaSQL= $conexion->prepare("SELECT * FROM documentos WHERE id=:id");
        $sentenciaSQL->bindParam(":id",$txtID);
        $sentenciaSQL->execute();
        $Documento=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
        $txtNombre = $Documento['nombre'];
        $txtImagen = $Documento['imagen'];
        break;

    case "Borrar":

        $sentenciaSQL= $conexion->prepare("SELECT tipo FROM documentos WHERE id=:id");
        $sentenciaSQL->bindParam(":id",$txtID);
        $sentenciaSQL->execute();
        $Documento=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($Documento["tipo"]) && ($Documento["tipo"] != "imagenPorDefecto.jpg")){
            if(file_exists("../../files/".$Documento["tipo"])){
                unlink("../../files/".$Documento["tipo"]);
            }
        }

        $sentenciaSQL= $conexion->prepare("DELETE FROM documentos WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID); 
        $sentenciaSQL->execute();
        break; 

}
$sentenciaSQL= $conexion->prepare("SELECT * FROM documentos");
$sentenciaSQL->execute();
$listaDocumentos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
//fetchAll para recuperar los registros y poder mostrarlos en la variable listaLIbros
//FETCH_ASSOC para crear una asociacion entre los registros y la tabla
?>

<div class="col-md-5">

    <div class="card">

        <div class="card-header">
            Datos de documentos
        </div>
        <div class="card-body">
           <form method="POST" enctype="multipart/form-data">
            <!-- le ponemos la propiedad enctype para recibir todo los tipos de datos -->
           <div class = "form-group">
           <label for="txtID">ID</label>
           <input type="text" required readonly class="form-control" value="<?php echo $txtID?>" name="txtID" id="txtID" placeholder="ID">
           </div>

           <div class="form-group">
           <label for="txtNombre">Nombre</label>
           <input type="text" required class="form-control" value= "<?php echo $txtNombre?>" name="txtNombre" id="txtNombre" placeholder="Nombre Documento">
           </div>

           <div class="form-group">
           <label  for="txtImagen">Archivo:</label><br>
           <?php if($txtImagen != ""){ ?>

                <img class ="img.thumbnail rounded"src = "../../files/<?php echo $txtImagen?>" width = "50" alt="" srcset="">
           
            <?php  }?>    

           <input type="file" required class="form-check-input" name="txtImagen" id="txtImagen" placeholder="Imagen">
           </div><br/>
            <br><br>
           <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":"";?> value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":"";?> value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":"";?> value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>
           </form>
           
           
        </div>

    </div>
      
</div>


    
    
</div>
<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Documento</th>
                <th>Vista previa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listaDocumentos as $documento) {?>
            <tr>
                <td><?php echo $documento['id']?></td>
                <td><?php echo $documento['nombre']?></td>
                <td>
                    
                    <img src = "../../files/<?php echo $documento['tipo']?>" width = "50">
                </td>

                <td>
                    <form method="POST">
                       <input type="hidden" name="txtID" value="<?php echo $documento['id']?>">
                       <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                       <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                    </form>
                </td>

            </tr>
           <?php } ?>
        </tbody>
    </table>
</div>
<?php include("../template/pie.php");?>