<?php
session_start();
if (isset($_SESSION['id'])){
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="bootstrap.min.css">
<script src="jquery-3.1.1.min.js" ></script>
<script src="bootstrap.min.js"></script>    
        <title>formulario cliente</title>
    </head>
    <body>
        <div class="container">
        <?php
           $formulario="cliente";
           include_once("menu.php");
           $pagina = (isset($_GET['pag']))?$_GET['pag']:"1";    
        ?>
<header>
<h1> formulario cliente </h1>
</header>
<table border="1">
<tbody>
<tr>
<th scope="col">nombre cliente</th>
<th scope="col">telefono cliente</th>
    <th scope="col">direccion cliente</th>
    <th scope="col">fecha registro  cliente</th>
<th scope="col"></th>
</tr>
<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/cliente.php");
$objetocliente = new cliente($conexion,0,'nombre','telefono','direccion','fecha');
$listaclientes = $objetocliente->listar($pagina);
    
$permiso = $objetocliente->getpermiso($_SESSION['id']);
if(stripos($permiso,'r')!==false){ //permiso
while($unregistro = mysqli_fetch_array ($listaclientes)){
    echo '<tr><form id="fmodificarcliente"'.$unregistro["idcliente"].' action="../controlador/controladorcliente.php"
    method="post">';
    echo '<td><input type="hidden" name="fidcliente"  value="'.$unregistro['idcliente'].'">';
    echo '<input class="form-control" type="text" name="fnombrecliente" value="'.$unregistro['nombrecliente'].'"></td>';
    echo '<td><input class="form-control" type="number" name="ftelefonocliente" value="'.$unregistro['telefonocliente'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fdireccioncliente" value="'.$unregistro['direccioncliente'].'"></td>';
    echo '<td><input class="form-control" type="date" name="ffecharegistrocliente" value="'.$unregistro['fecharegistrocliente'].'"></td>';
        
    echo '<td><button class="btn btn-success" type="submit" name="fenviar" value="modificar">Modificar</button>
    <button class="btn btn-danger" type="submit" name="fenviar" value="eliminar">Eliminar</button></td>';
    echo '</form> </tr>';
}
    }//fin permiso
?>
<tr><form id="fingresarcliente" action="../controlador/controladorcliente.php" method="post">
<td><input type="hidden" name="fidcliente" value="0">
    <input class="form-control" type="text" name="fnombrecliente"></td>
<td><input class="form-control" type="number" name="ftelefonocliente"></td>
    <td><input class="form-control" type="text" name="fdireccioncliente"></td>
<td><input class="form-control" type="date" name="ffecharegistrocliente"></td>

<td><button class="btn btn-primary" type="submit" name="fenviar" value="ingresar">Ingresar</button>
<button class="btn btn-primary"  type="reset" name="fenviar" value="limpiar">Limpiar</button></td>
</form> </tr>
</tbody>
</table>
    <nav><ul class="paginacion">
<?php
$cantidadpaginas=$objetocliente->cantidadpaginas();
if($cantidadpaginas>1){
    if($pagina>1){//mostrar el de ir atras cuando no sea la primer pagina
    echo'<li><a href="formulariocliente.php?pag='.($pagina-1).'"aria-label="anterior">
    <span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantidadpaginas;$i++){
        if($i==$pagina){
            echo'<li class="active"><a href="#">'.$i.'</a></li>';

        }else{
            echo'<li><a href="formulariocliente.php?pag='.$i.'">'.$i.'</a></li>';

        }
    }
    if ($pagina<$cantidadpaginas){//mostrar el de ir adelante cuando no sea la ultima pagina
echo'<li><a href="formulariocliente.php?pag='.($pagina+1).'"aria-label="siguiente">
   <span aria-hidden="true=>&raquio;</span></a></li>';
    }
}
?>
</ul></nav>        
            
<?php
    mysqli_free_result($listaclientes);
    $objetoconexion->desconectar($conexion);
?>
              </div>
</body>
  
</html>
<?php
}else{
    header( "location:../index.php");
     }
?>

