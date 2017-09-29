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
        
    <title>formulario auditoria</title>
    </head>
    <body>
         <div class="container">
        <?php
           $formulario="auditoria";
           include_once("menu.php");
             $pagina = (isset($_GET['pag']))?$_GET['pag']:"1"; 
        ?>
        
<header>
<h1> formulario auditoria</h1>
</header>
<table border="1">
<tbody>
<tr>
<th scope="col">fecha auditoria</th>
<th scope="col">descripcion auditoria</th>
<th scope="col">id usuario auditoria</th>
 
  
<th scope="col"></th>
</tr>
<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();
    
include_once("../modelo/usuario.php");
$objetousuario= new usuario($conexion,0,'nombre','email','clave','fecharegistro','fechaultima','idrol');
$listausuarios= $objetousuario->listar(0);

include_once("../modelo/auditoria.php");
$objetoauditoria = new auditoria($conexion,0,'fecha','descripcion','idusuario');
$listaauditorias = $objetoauditoria->listar($pagina);
    
$permiso = $objetoauditoria->getpermiso($_SESSION['id']);
if(stripos($permiso,'r')!==false){ //permiso
while($unregistro = mysqli_fetch_array ($listaauditorias)){
    echo '<tr><form id="fmodificarauditorias"'.$unregistro["idauditoria"].' action="../controlador/controladorauditoria.php"
    method="post">';
    echo '<td><input type="hidden" name="fidauditoria"  value="'.$unregistro['idauditoria'].'">';
    echo '<input class="form-control" type="datetime" name="ffechaauditoria" value="'.$unregistro['fechaauditoria'].'"></td>';
    echo '<td><input class="form-control" type="text" name="fdescripcionauditoria" value="'.$unregistro['descripcionauditoria'].'"></td>';
    
    
    
    echo '<td><select name="fidusuarioauditoria" class="form-control">';
    while($registrousuario= mysqli_fetch_array ($listausuarios)){
        echo '<option value="'.$registrousuario['idusuario'].'"';
        if($unregistro['idusuarioauditoria']==$registrousuario['idusuario']){
             echo " selected ";
        }
       echo '>'.$registrousuario['nombreusuario'].'</option>';
    }
     mysqli_data_seek($listausuarios,0);
     echo "</select></td>";

        
    echo '<td><button class="btn btn-success" type="submit" name="fenviar" value="modificar">Modificar</button>
    <button  class="btn btn-danger" type="submit" name="fenviar" value="eliminar">Eliminar</button></td>';
    echo '</form> </tr>';
}
    }//fin permiso
?>
<tr><form id="fingresarauditoria" action="../controlador/controladorauditoria.php" method="post">
<td><input type="hidden" name="fidauditoria" value="0">
    <input class="form-control" type="datetime" name="ffechaauditoria"></td>
<td><input class="form-control" type="text" name="fdescripcionauditoria"></td>

    
    
     <td><select name="fidusuarioauditoria" class="form-control">
    <?php
    while($registrousuarioauditoria = mysqli_fetch_array ($listausuarios)){
        echo '<option value="'.$registrousuarioauditoria['idusuario'].'">'.$registrousuarioauditoria['nombreusuario'].'</option>';
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
$cantidadpaginas=$objetoauditoria->cantidadpaginas();
if($cantidadpaginas>1){
    if($pagina>1){//mostrar el de ir atras cuando no sea la primer pagina
    echo'<li><a href="formularioauditoria.php?pag='.($pagina-1).'"aria-label="anterior">
    <span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantidadpaginas;$i++){
        if($i==$pagina){
            echo'<li class="active"><a href="#">'.$i.'</a></li>';

        }else{
            echo'<li><a href="formularioauditoria.php?pag='.$i.'">'.$i.'</a></li>';

        }
    }
    if($pagina<$cantidadpaginas){//mostrar el de ir adelante cuando no sea la ultima pagina
echo'<li><a href="formularioauditoria.php?pag='.($pagina+1).'"aria-label="siguiente">
   <span aria-hidden="true=>&raquio;</span></a></li>';
    }
}
?>
</ul></nav>       
             
             
             
<?php
    mysqli_free_result($listausuarios);
    mysqli_free_result($listaauditorias);
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