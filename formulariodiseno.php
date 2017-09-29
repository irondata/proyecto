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
        <title>formulario diseno</title>
    </head>
    <body>
        <div class="container">
        <?php
           $formulario="diseno";
           include_once("menu.php");
            $pagina = (isset($_GET['pag']))?$_GET['pag']:"1"; 
        ?>
<header>
<h1> formulario diseno</h1>
</header>
<table border="1">
<tbody>
<tr>
<th scope="col">ruta diseno</th>
<th scope="col">id material diseno</th>
 
  
<th scope="col"></th>
</tr>
<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();
    
include_once("../modelo/material.php");
$objetomaterial = new material($conexion,0,'nombre','idproveedor');
$listamateriales = $objetomaterial->listar(0);

include_once("../modelo/diseno.php");
$objetodiseno = new diseno($conexion,0,'ruta','idmaterial');
$listadisenos = $objetodiseno->listar($pagina);
    
$permiso = $objetodiseno->getpermiso($_SESSION['id']);
if(stripos($permiso,'r')!==false){ //permiso
while($unregistro = mysqli_fetch_array ($listadisenos)){
    echo '<tr><form id="fmodificardiseno"'.$unregistro["iddiseno"].' action="../controlador/controladordiseno.php"
    method="post">';
    echo '<td><input  type="hidden" name="fiddiseno"  value="'.$unregistro['iddiseno'].'">';
    echo '<input class="form-control"  type="text" name="frutadiseno" value="'.$unregistro['rutadiseno'].'"></td>';

       echo '<td><select name="fidmaterialdiseno" class="form-control">';
    while($registromaterial = mysqli_fetch_array ($listamateriales)){
        echo '<option value="'.$registromaterial['idmaterial'].'"';
        if($unregistro['idmaterialdiseno']==$registromaterial['idmaterial']){
             echo " selected ";
        }
       echo '>'.$registromaterial['nombrematerial'].'</option>';
    }
     mysqli_data_seek($listamateriales,0);
     echo "</select></td>";
    
    
        
    echo '<td><button class="btn btn-success"  type="submit" name="fenviar" value="modificar">Modificar</button>
    <button class="btn btn-danger"  type="submit" name="fenviar" value="eliminar">Eliminar</button></td>';
    echo '</form> </tr>';
}
      }//fin permiso
?>
<tr><form id="fingresardiseno" action="../controlador/controladordiseno.php" method="post">
<td><input type="hidden" name="fiddiseno" value="0">
    <input class="form-control"  type="text" name="frutadiseno"></td>

    
     <td><select name="fidmaterialdiseno" class="form-control">
    <?php
    while($registromaterialdiseno= mysqli_fetch_array ($listamateriales)){
        echo '<option value="'.$registromaterialdiseno['idmaterial'].'">'.$registromaterialdiseno['nombrematerial'].'</option>';
    }
  
    ?>
</select></td>

<td><button class="btn btn-primary"  type="submit" name="fenviar" value="ingresar">Ingresar</button>
<button class="btn btn-primary"  type="reset" name="fenviar" value="limpiar">Limpiar</button></td>
</form> </tr>
</tbody>
</table>
            
   <nav><ul class="paginacion">
<?php
$cantidadpaginas=$objetodiseno->cantidadpaginas();
if($cantidadpaginas>1){
    if($pagina>1){//mostrar el de ir atras cuando no sea la primer pagina
    echo'<li><a href="formulariodiseno.php?pag='.($pagina-1).'"aria-label="anterior">
    <span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantidadpaginas;$i++){
        if($i==$pagina){
            echo'<li class="active"><a href="#">'.$i.'</a></li>';

        }else{
            echo'<li><a href="formulariodiseno.php?pag='.$i.'">'.$i.'</a></li>';

        }
    }
    if ($pagina<$cantidadpaginas){//mostrar el de ir adelante cuando no sea la ultima pagina
echo'<li><a href="formulariodiseno.php?pag='.($pagina+1).'"aria-label="siguiente">
   <span aria-hidden="true=>&raquio;</span></a></li>';
    }
}
?>
</ul></nav>         
<?php
    mysqli_free_result($listamateriales);
    mysqli_free_result($listadisenos);
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