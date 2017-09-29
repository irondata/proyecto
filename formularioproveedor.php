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
        <title>formulario proveedor</title>
    </head>
    <body>
        <div class="container">
        <?php
           $formulario="proveedor";
           include_once("menu.php");
            $pagina = (isset($_GET['pag']))?$_GET['pag']:"1"; 
        ?>
<header>
<h1> formulario proveedor</h1>
</header>
<table border="1">
<tbody>
<tr>
<th scope="col">nombre proveedor</th>
<th scope="col">celular proveedor</th>
<th scope="col">direccion proveedor</th>
 
  
<th scope="col"></th>
</tr>
<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/proveedor.php");
$objetoproveedor = new proveedor($conexion,0,'nombre','celular','direccion');
$listaproveedores = $objetoproveedor->listar($pagina);

$permiso = $objetoproveedor->getpermiso($_SESSION['id']);
if(stripos($permiso,'r')!==false){ //permiso
    while($unregistro = mysqli_fetch_array ($listaproveedores)){
        echo '<tr><form id="fmodificarproveedor"'.$unregistro["idproveedor"].' action="../controlador/controladorproveedor.php"
        method="post">';
        echo '<td><input type="hidden" name="fidproveedor"  value="'.$unregistro['idproveedor'].'">';
        echo '<input  class="form-control" type="text" name="fnombreproveedor" value="'.$unregistro['nombreproveedor'].'"></td>';
        echo '<td><input  class="form-control" type="number" name="fcelularproveedor" value="'.$unregistro['celularproveedor'].'"></td>';
         echo '<td><input  class="form-control" type="text" name="fdireccionproveedor" value="'.$unregistro['direccionproveedor'].'"></td>';


        echo '<td><button class="btn btn-success" type="submit" name="fenviar" value="modificar">Modificar</button>
        <button class="btn btn-danger" type="submit" name="fenviar" value="eliminar">Eliminar</button></td>';
        echo '</form> </tr>';
    }
}//fin permiso
?>
<tr><form id="fingresarproveedor" action="../controlador/controladorproveedor.php" method="post">
<td><input type="hidden" name="fidproveedor" value="0">
    <input  class="form-control" type="text" name="fnombreproveedor"></td>
<td><input  class="form-control" type="number" name="fcelularproveedor"></td>
<td><input  class="form-control" type="text" name="fdireccionproveedor"></td>


<td><button class="btn btn-primary" type="submit" name="fenviar" value="ingresar">Ingresar</button>
<button class="btn btn-primary" type="reset" name="fenviar" value="limpiar">Limpiar</button></td>
</form> </tr>
</tbody>
</table>
    <nav><ul class="paginacion">
<?php
$cantidadpaginas=$objetoproveedor->cantidadpaginas();
if($cantidadpaginas>1){
    if($pagina>1){//mostrar el de ir atras cuando no sea la primer pagina
    echo'<li><a href="formularioproveedor.php?pag='.($pagina-1).'"aria-label="anterior">
    <span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantidadpaginas;$i++){
        if($i==$pagina){
            echo'<li class="active"><a href="#">'.$i.'</a></li>';

        }else{
            echo'<li><a href="formularioproveedor.php?pag='.$i.'">'.$i.'</a></li>';

        }
    }
    if($pagina<$cantidadpaginas){//mostrar el de ir adelante cuando no sea la ultima pagina
echo'<li><a href="formularioproveedor.php?pag='.($pagina+1).'"aria-label="siguiente">
   <span aria-hidden="true=>&raquio;</span></a></li>';
    }
}
?>
</ul></nav>        
            
            
<?php
    mysqli_free_result($listaproveedores);
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