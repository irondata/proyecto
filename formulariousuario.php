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
        <title>formulario usuario</title>
    </head>
    <body>
        <div class="container">
        <?php
           $formulario="usuario";
           include_once("menu.php");
            $pagina = (isset($_GET['pag']))?$_GET['pag']:"1"; 
        ?>
        
<header>
<h1> formulario usuario</h1>
</header>
<table border="1">
<tbody>
<tr>

<th scope="col">nombre usuario</th>
    <th scope="col">email usuario</th>
<th scope="col">clave usuario</th>
<th scope="col">fecha registro usuario</th>
<th scope="col">fecha ultima clave usuario</th>
<th scope="col"> id rol usuario</th>
 
  
<th scope="col"></th>
</tr>
<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();
    
    
include_once("../modelo/rol.php");
$objetorol= new rol($conexion,0,'nombre','elemento','proveedor','empleados','diseno','material','pedio','detallepedio','venta','usuario','auditoria','idrol');
$listarol= $objetorol->listar(0);
    
    
    

include_once("../modelo/usuario.php");
$objetousuario= new usuario($conexion,0,'nombre','email','clave','fecharegistro','fechaultima','idrol');
$listausuarios= $objetousuario->listar($pagina);
    
$permiso = $objetousuario->getpermiso($_SESSION['id']);
if(stripos($permiso,'r')!==false){ //permiso
while($unregistro = mysqli_fetch_array ($listausuarios)){
    echo '<tr><form id="fmodificarusuario"'.$unregistro["idusuario"].' action="../controlador/controladorusuario.php"
    method="post">';
    echo '<td><input type="hidden" name="fidusuario"  value="'.$unregistro['idusuario'].'">';
    echo '<input  class="form-control" type="text" name="fnombreusuario" value="'.$unregistro['nombreusuario'].'"></td>';
    echo '<td><input  class="form-control" type="text" name="femailusuario" value="'.$unregistro['emailusuario'].'"></td>';
    echo '<td><input  class="form-control" type="password" name="fclaveusuario" value="'.$unregistro['claveusuario'].'"></td>';
    echo '<td><input  class="form-control" type="date" name="ffecharegistrousuario" value="'.$unregistro['fecharegistrousuario'].'"></td>';
    echo '<td><input  class="form-control" type="date" name="ffechaultimaclaveusuario" value="'.$unregistro['fechaultimaclaveusuario'].'"></td>';
   
    
    
      echo '<td><select name="fidrolusuario" class="form-control">';
    while($registrorol= mysqli_fetch_array ($listarol)){
        echo '<option value="'.$registrorol['idrol'].'"';
        if($unregistro['idrolusuario']==$registrorol['idrol']){
             echo " selected ";
        }
       echo '>'.$registrorol['nombrerol'].'</option>';
    }
     mysqli_data_seek($listarol,0);
     echo "</select></td>";

        
    echo '<td><button class="btn btn-success" type="submit" name="fenviar" value="modificar">Modificar</button>
    <button class="btn btn-danger" type="submit" name="fenviar" value="eliminar">Eliminar</button></td>';
    echo '</form> </tr>';
}
      }//fin permiso
?>
<tr><form id="fingresarusuario" action="../controlador/controladorusuario.php" method="post">
<td><input type="hidden" name="fidusuario" value="0">
    <input  class="form-control" type="text" name="fnombreusuario"></td>
<td><input  class="form-control" type="text" name="femailusuario"></td>
<td><input  class="form-control" type="password" name="fclaveusuario"></td>
    <td><input  class="form-control" type="date" name="ffecharegistrousuario"></td>
    <td><input  class="form-control" type="date" name="ffechaultimaclaveusuario"></td>


       <td><select name="fidrolusuario" class="form-control">
    <?php
    while($registrorolusuario = mysqli_fetch_array ($listarol)){
        echo '<option value="'.$registrorolusuario['idrol'].'">'.$registrorolusuario['nombrerol'].'</option>';
    }
    ?>
</select></td>

<td><button class="btn btn-primary" type="submit" name="fenviar" value="ingresar">Ingresar</button>
<button class="btn btn-primary" type="reset" name="fenviar" value="limpiar">Limpiar</button></td>
</form> </tr>
</tbody>
</table>
            <nav><ul class="paginacion">
<?php
$cantidadpaginas=$objetousuario->cantidadpaginas();
if($cantidadpaginas>1){
    if($pagina>1){//mostrar el de ir atras cuando no sea la primer pagina
    echo'<li><a href="formulariousuario.php?pag='.($pagina-1).'"aria-label="anterior">
    <span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantidadpaginas;$i++){
        if($i==$pagina){
            echo'<li class="active"><a href="#">'.$i.'</a></li>';

        }else{
            echo'<li><a href="formulariousuario.php?pag='.$i.'">'.$i.'</a></li>';

        }
    }
    if($pagina<$cantidadpaginas){//mostrar el de ir adelante cuando no sea la ultima pagina
echo'<li><a href="formulariousuario.php?pag='.($pagina+1).'"aria-label="siguiente">
   <span aria-hidden="true=>&raquio;</span></a></li>';
    }
}
?>
</ul></nav>
<?php
    mysqli_free_result($listarol);
    mysqli_free_result($listausuarios);
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