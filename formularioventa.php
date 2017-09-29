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
        <title>formulario venta</title>
    </head>
    <body>
        <div class="container">
        <?php
           $formulario="venta";
           include_once("menu.php");
            $pagina = (isset($_GET['pag']))?$_GET['pag']:"1"; 
        ?>
<header>
<h1> formulario venta</h1>
</header>
<table border="1">
<tbody>
<tr>

<th scope="col">fecha venta</th>
<th scope="col">id empleados venta</th>
<th scope="col">id pedido venta</th>
 
  
<th scope="col"></th>
</tr>
<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();
    
    
include_once("../modelo/empleados.php");
$objetoempleados= new empleados($conexion,0,'nombre','telefono','direccion');
$listaempleados= $objetoempleados->listar(0);
    
    
include_once("../modelo/pedido.php");
$objetopedido= new pedido($conexion,0,'fecha','valor','idcliente');
$listapedidos = $objetopedido->listar(0);

include_once("../modelo/venta.php");
$objetoventa= new venta($conexion,0,'fecha','idempleados','idpedido');
$listaventas = $objetoventa->listar($pagina);
    
$permiso = $objetoventa->getpermiso($_SESSION['id']);
if(stripos($permiso,'r')!==false){ //permiso
while($unregistro = mysqli_fetch_array ($listaventas)){
    echo '<tr><form id="fmodificarventa"'.$unregistro["idventa"].' action="../controlador/controladorventa.php"
    method="post">';
    echo '<td><input type="hidden" name="fidventa"  value="'.$unregistro['idventa'].'">';
    echo '<input  class="form-control" type="date" name="ffechaventa" value="'.$unregistro['fechaventa'].'"></td>';
    

    echo '<td><select name="fidempleadosventa" class="form-control">';
    while($registroempleados= mysqli_fetch_array ($listaempleados)){
        echo '<option value="'.$registroempleados['idemleados'].'"';
        if($unregistro['idempleadosventa']==$registroempleados['idempleados']){
             echo " selected ";
        }
       echo '>'.$registroempleados['nombreempleados'].'</option>';
    }
     mysqli_data_seek($listaempleados,0);
     echo "</select></td>";
    
    
    
      echo '<td><select name="fidpedidoventa" class="form-control">';
    while($registropedido= mysqli_fetch_array ($listapedidos)){
        echo '<option value="'.$registropedido['idpedido'].'"';
        if($unregistro['idpedidoventa']==$registropedido['idpedido']){
             echo " selected ";
        }
       echo '>'.$registropedido['valorpedido'].'</option>';
    }
     mysqli_data_seek($listapedidos,0);
     echo "</select></td>";
    
    echo '<td><button class="btn btn-success" type="submit" name="fenviar" value="modificar">Modificar</button>
    <button class="btn btn-danger" type="submit" name="fenviar" value="eliminar">Eliminar</button></td>';
    echo '</form> </tr>';
}
      }//fin permiso
?>
<tr><form id="fingresarventa" action="../controlador/controladorventa.php" method="post">
<td><input type="hidden" name="fidventa" value="0">
    <input  class="form-control" type="date" name="ffechaventa"></td>

    
    <td><select name="fidempleadosventa" class="form-control">
    <?php
    while($registroempleadosventa = mysqli_fetch_array ($listaempleados)){
        echo '<option value="'.$registroempleadosventa['idempleados'].'">'.$registroempleadosventa['nombreempleados'].'</option>';
    }
    ?>
</select></td>

    
    <td><select name="fidpedidoventa" class="form-control">
    <?php
    while($registropedidoventa = mysqli_fetch_array ($listapedidos)){
        echo '<option value="'.$registropedidoventa['idpedidos'].'">'.$registropedidoventa['valorpedido'].'</option>';
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
$cantidadpaginas=$objetoventa->cantidadpaginas();
if($cantidadpaginas>1){
    if($pagina>1){//mostrar el de ir atras cuando no sea la primer pagina
    echo'<li><a href="formularioventa.php?pag='.($pagina-1).'"aria-label="anterior">
    <span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantidadpaginas;$i++){
        if($i==$pagina){
            echo'<li class="active"><a href="#">'.$i.'</a></li>';

        }else{
            echo'<li><a href="formularioventa.php?pag='.$i.'">'.$i.'</a></li>';

        }
    }
    if($pagina<$cantidadpaginas){//mostrar el de ir adelante cuando no sea la ultima pagina
echo'<li><a href="formularioventa.php?pag='.($pagina+1).'"aria-label="siguiente">
   <span aria-hidden="true=>&raquio;</span></a></li>';
    }
}
?>
</ul></nav>         
            
<?php
    mysqli_free_result($listapedidos);
    mysqli_free_result($listaempleados);
    mysqli_free_result($listaventas);
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