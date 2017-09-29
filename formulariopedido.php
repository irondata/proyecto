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
        <title>formulario pedido</title>
    </head>
    <body>
        <div class="container">
        
        <?php
           $formulario="pedido";
           include_once("menu.php");
            $pagina = (isset($_GET['pag']))?$_GET['pag']:"1"; 
        ?>
<header>
<h1> formulario pedido</h1>
</header>
<table border="1">
<tbody>
<tr>
<th scope="col">fecha pedido</th>
<th scope="col">valor pedido</th>
<th scope="col">id cliente pedido</th>
<th scope="col"></th>
</tr>
<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();
    
    
include_once("../modelo/cliente.php");
$objetocliente = new cliente($conexion,0,'nombre','telefono','direccion','fecha');
$listaclientes = $objetocliente->listar(0);

    
include_once("../modelo/pedido.php");
$objetopedido= new pedido($conexion,0,'fecha','valor','idcliente');
$listapedidos = $objetopedido->listar($pagina);
    
$permiso = $objetopedido->getpermiso($_SESSION['id']);
if(stripos($permiso,'r')!==false){ //permiso
while($unregistro = mysqli_fetch_array ($listapedidos)){
    echo '<tr><form id="fmodificarpedido"'.$unregistro["idpedido"].' action="../controlador/controladorpedido.php"
    method="post">';
    echo '<td><input type="hidden" name="fidpedido"  value="'.$unregistro['idpedido'].'">';
    echo '<input class="form-control" type="date" name="ffechapedido" value="'.$unregistro['fechapedido'].'"></td>';
    echo '<td><input class="form-control" type="number" name="fvalorpedido" value="'.$unregistro['valorpedido'].'"></td>';
    
    
    
     echo '<td><select name="fidclientepedido" class="form-control">';
    while($registrocliente= mysqli_fetch_array ($listaclientes)){
        echo '<option value="'.$registrocliente['idcliente'].'"';
        if($unregistro['idclientepedido']==$registrocliente['idcliente']){
             echo " selected ";
        }
       echo '>'.$registrocliente['nombrecliente'].'</option>';
    }
     mysqli_data_seek($listaclientes,0);
     echo "</select></td>";
    
    echo '<td><button class="btn btn-success"  type="submit" name="fenviar" value="modificar">Modificar</button>
    <button class="btn btn-danger"  type="submit" name="fenviar" value="eliminar">Eliminar</button></td>';
    echo '</form> </tr>';
}
      }//fin permiso
?>
<tr><form id="fingresarpedido" action="../controlador/controladorpedido.php" method="post">
<input type="hidden" name="fidpedido" value="0">
    <td><input class="form-control" type="date" name="ffechapedido"></td>
<td><input class="form-control" type="number" name="fvalorpedido"></td>

    
    
    <td><select name="fidclientepedido" class="form-control">
    <?php
    while($registroclientepedido = mysqli_fetch_array ($listaclientes)){
        echo '<option value="'.$registroclientepedido['idcliente'].'">'.$registroclientepedido['nombrecliente'].'</option>';
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
$cantidadpaginas=$objetopedido->cantidadpaginas();
if($cantidadpaginas>1){
    if($pagina>1){//mostrar el de ir atras cuando no sea la primer pagina
    echo'<li><a href="formulariopedido.php?pag='.($pagina-1).'"aria-label="anterior">
    <span aria-hidden="true">&laquo;</span></a></li>';
    }
    for($i=1;$i<=$cantidadpaginas;$i++){
        if($i==$pagina){
            echo'<li class="active"><a href="#">'.$i.'</a></li>';

        }else{
            echo'<li><a href="formulariopedido.php?pag='.$i.'">'.$i.'</a></li>';

        }
    }
    if($pagina<$cantidadpaginas){//mostrar el de ir adelante cuando no sea la ultima pagina
echo'<li><a href="formulariopedido.php?pag='.($pagina+1).'"aria-label="siguiente">
   <span aria-hidden="true=>&raquio;</span></a></li>';
    }
}
?>
</ul></nav>        
            
<?php
    mysqli_free_result($listaclientes);   
    mysqli_free_result($listapedidos);
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