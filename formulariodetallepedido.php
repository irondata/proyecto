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
        <title>formulario detalle pedido</title>
    </head>
    <body>
       <div class="container">
           
        <?php
           $formulario="detallepedido";
           include_once("menu.php");
           $pagina = (isset($_GET['pag']))?$_GET['pag']:"1"; 
        ?>
<header>
<h1> formulario detalle pedido </h1>
</header>
<table border="1">
<tbody>
<tr>
<th scope="col">cantidad de pedido</th>
<th scope="col">id pedido detalle pedido</th>
    <th scope="col">id diseño</th>
  
<th scope="col"></th>
</tr>
<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();
    
include_once("../modelo/pedido.php");
$objetopedido= new pedido($conexion,0,'fecha','valor','idcliente');
$listapedidos = $objetopedido->listar(0);
    
include_once("../modelo/diseno.php");
$objetodiseno = new diseno($conexion,0,'ruta','idmaterial');
$listadisenos = $objetodiseno->listar(0);
    
    

include_once("../modelo/detallepedido.php");
$objetodetallepedido = new detallepedido($conexion,0,'cantidad','idpedido','iddiseno');
$listadetallepedidos = $objetodetallepedido->listar($pagina);
    
$permiso = $objetodetallepedido->getpermiso($_SESSION['id']);
if(stripos($permiso,'r')!==false){ //permiso
while($unregistro = mysqli_fetch_array ($listadetallepedidos)){
    echo '<tr><form id="fmodificardetallepedido"'.$unregistro["iddetallepedido"].' action="../controlador/controladordetallepedido.php"
    method="post">';
    echo '<input type="hidden" name="fiddetallepedido"  value="'.$unregistro['iddetallepedido'].'">';
    echo '<td><input  class="form-control" type="number" name="fcantidaddepedidodetallepedido" value="'.$unregistro['cantidaddepedidodetallepedido'].'"></td>';

     echo '<td><select name="fidpedidodetallepedido" class="form-control">';
    while($registropedido = mysqli_fetch_array ($listapedidos)){
        echo '<option value="'.$registropedido['idpedido'].'"';
        if($unregistro['idpedidodetallepedido']==$registropedido['idpedido']){
             echo " selected ";
        }
       echo '>'.$registropedido['valorpedido'].'</option>';
    }
     mysqli_data_seek($listapedidos,0);
     echo "</select></td>";
    
    
      echo '<td><select name="fiddisenodetallepedido" class="form-control">';
    while($registrodiseno = mysqli_fetch_array ($listadisenos)){
        echo '<option value="'.$registrodiseno['iddiseno'].'"';
        if($unregistro['iddisenodetallepedido']==$registrodiseno['iddiseno']){
             echo " selected ";
        }
       echo '>'.$registrodiseno['rutadiseno'].'</option>';
    }
     mysqli_data_seek($listadisenos,0);
     echo "</select></td>";
    
    
    
        
    echo '<td><button class="btn btn-success" type="submit" name="fenviar" value="modificar">Modificar</button>
    <button class="btn btn-danger" type="submit" name="fenviar" value="eliminar">Eliminar</button></td>';
    echo '</form> </tr>';
}
    }//fin permiso
?>
<tr><form id="fingresardetallepedido" action="../controlador/controladordetallepedido.php" method="post">
    <td><input type="hidden" name="fiddetallepedido" value="0">
        <input  class="form-control" type="number" name="fcantidaddepedidodetallepedido"></td>

    <td><select name="fidpedidodetallepedido" class="form-control">
    <?php
    while($registropedidodetallepedido = mysqli_fetch_array ($listapedidos)){
        echo '<option value="'.$registropedidodetallepedido['idpedido'].'">'.$registropedidodetallepedido['valorpedido'].'</option>';
    }
    ?>
</select></td>
    
    <td><select name="fiddisenodetallepedido" class="form-control">
    <?php
    while($registrodisenodetallepedido = mysqli_fetch_array ($listadisenos)){
        echo '<option value="'.$registrodisenodetallepedido['iddiseno'].'">'.$registrodisenodetallepedido['rutadiseno'].'</option>';
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
$cantidadpaginas=$objetodetallepedido->cantidadpaginas();
if($cantidadpaginas>1){
    if($pagina>1){//mostrar el de ir atras cuando no sea la primer pagina
    echo'<li><a href="formulariodetallepedido.php?pag='.($pagina-1).'"aria-label="anterior">
    <span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantidadpaginas;$i++){
        if($i==$pagina){
            echo'<li class="active"><a href="#">'.$i.'</a></li>';

        }else{
            echo'<li><a href="formulariodetallepedido.php?pag='.$i.'">'.$i.'</a></li>';

        }
    }
    if($pagina<$cantidadpaginas){//mostrar el de ir adelante cuando no sea la ultima pagina
echo'<li><a href="formulariodetallepedido.php?pag='.($pagina+1).'"aria-label="siguiente">
   <span aria-hidden="true=>&raquio;</span></a></li>';
    }
}
?>
</ul></nav>     
           
           
           
<?php
    mysqli_free_result($listadisenos);
    mysqli_free_result($listapedidos);
    mysqli_free_result($listadetallepedidos);
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