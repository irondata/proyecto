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
        <title>formulario rol</title>
    </head>
    <body>
        <div class="container">
        
        <?php
           $formulario="rol";
           include_once("menu.php");
            $pagina = (isset($_GET['pag']))?$_GET['pag']:"1"; 
        ?>
<header>
<h1> formulario rol</h1>
</header>
<table border="1">
<tbody>
<tr>
<th scope="col">nombre rol</th>
<th scope="col">elemento rol</th>
<th scope="col">proveedor rol</th>
<th scope="col">empleados rol</th>
<th scope="col">diseno rol</th>
<th scope="col"> material rol</th>
<th scope="col"> pedido rol</th>
<th scope="col"> detalle pedido rol</th>
<th scope="col"> venta rol</th>
<th scope="col"> usuario rol</th>
<th scope="col"> auditoria rol</th>
<th scope="col"> cliente rol</th>
<th scope="col"> rol rol</th>  
<th scope="col"></th>

</tr>
<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/rol.php");
$objetorol= new rol($conexion,0,'nombre','elemento','proveedor','empleados','diseno','material','pedio','detallepedio','venta','usuario','auditoria','cliente','idrol');
$listarol= $objetorol->listar($pagina);
    
$permiso = $objetorol->getpermiso($_SESSION['id']);
if(stripos($permiso,'r')!==false){ //permiso
while($unregistro = mysqli_fetch_array ($listarol)){
    echo '<tr><form id="fmodificarrol"'.$unregistro["idrol"].' action="../controlador/controladorrol.php"
    method="post">';
    echo '<td><input type="hidden" name="fidrol"  value="'.$unregistro['idrol'].'">';
    echo '<input class="form-control" type="text" name="fnombrerol" value="'.$unregistro['nombrerol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="felementorol" value="'.$unregistro['elementorol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fproveedorrol" value="'.$unregistro['proveedorrol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fempleadosrol" value="'.$unregistro['empleadosrol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fdisenorol" value="'.$unregistro['disenorol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fmaterialrol" value="'.$unregistro['materialrol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fpedidorol" value="'.$unregistro['pedidorol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fdetallepedidorol" value="'.$unregistro['detallepedidorol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fventarol" value="'.$unregistro['ventarol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fusuariorol" value="'.$unregistro['usuariorol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fauditoriarol" value="'.$unregistro['auditoriarol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fclienterol" value="'.$unregistro['clienterol'].'"></td>';
    echo '<td><input class="form-control" type="text" name="frolrol" value="'.$unregistro['rolrol'].'"></td>';
    
    
        
    echo '<td><button class="btn btn-success" type="submit" name="fenviar" value="modificar">Modificar</button>
    <button class="btn btn-danger" type="submit" name="fenviar" value="eliminar">Eliminar</button></td>';
    echo '</form> </tr>';
}
      }//fin permiso
?>
<tr><form id="fingresarrol" action="../controlador/controladorrol.php" method="post">
<td><input type="hidden" name="fidrol" value="0">
    <input class="form-control" type="text" name="fnombrerol"></td>
 <td><input class="form-control" type="text" name="felementorol"></td>
 <td><input class="form-control" type="text" name="fproveedorrol"></td>
 <td><input class="form-control" type="text" name="fempleadosrol"></td>
 <td><input class="form-control" type="text" name="fdisenorol"></td>
 <td><input class="form-control" type="text" name="fmaterialrol"></td>
 <td><input class="form-control" type="text" name="fpedidorol"></td>
 <td><input class="form-control" type="text" name="fdetallpedidorol"></td>
 <td><input class="form-control" type="text" name="fventarol"></td>
 <td><input class="form-control" type="text" name="fusuariorol"></td>
 <td><input class="form-control" type="text" name="fauditoriarol"></td>
<td><input class="form-control" type="text" name="fclienterol"></td>
 <td><input class="form-control" type="text" name="frolrol"></td>

<td><button class="btn btn-primary" type="submit" name="fenviar" value="ingresar">Ingresar</button>
<button class="btn btn-primary" type="reset" name="fenviar" value="limpiar">Limpiar</button></td>
</form> </tr>
</tbody>
</table>
            
       <nav><ul class="paginacion">
<?php
$cantidadpaginas=$objetorol->cantidadpaginas();
if($cantidadpaginas>1){
    if($pagina>1){//mostrar el de ir atras cuando no sea la primer pagina
    echo'<li><a href="formulariorol.php?pag='.($pagina-1).'"aria-label="anterior">
    <span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantidadpaginas;$i++){
        if($i==$pagina){
            echo'<li class="active"><a href="#">'.$i.'</a></li>';

        }else{
            echo'<li><a href="formulariorol.php?pag='.$i.'">'.$i.'</a></li>';

        }
    }
    if($pagina<$cantidadpaginas){//mostrar el de ir adelante cuando no sea la ultima pagina
echo'<li><a href="formulariorol.php?pag='.($pagina+1).'"aria-label="siguiente">
   <span aria-hidden="true=>&raquio;</span></a></li>';
    }
}
?>
</ul></nav>     
            
            
            
<?php
    mysqli_free_result($listarol);
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