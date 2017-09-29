<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/detallepedido.php");

$opcion = $_POST["fenviar"];
$iddetallepedido= $_POST["fiddetallepedido"];
$cantidaddepedidodetallepedido = $_POST["fcantidaddepedidodetallepedido"];
$idpedidodetallepedido= $_POST["fidpedidodetallepedido"];
$iddisenodetallepedido= $_POST["fiddisenodetallepedido"];



$cantidaddepedidodetallepedido= htmlspecialchars($cantidaddepedidodetallepedido);
$idpedidodetallepedido = htmlspecialchars($idpedidodetallepedido);
$iddisenodettalepedido= htmlspecialchars($iddisenodetallepedido);



$objetodetallepedido= new detallepedido($conexion,$iddetallepedido,$cantidaddepedidodetallepedido,$idpedidodetallepedido,$iddisenodetallepedido);

switch($opcion){
    case 'ingresar':
    $objetodetallepedido->insertar();
    $mensaje = "ingresado";
    break;

    case 'modificar':
        $objetodetallepedido->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetodetallepedido->eliminar();
    $mensaje = "eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formulariodetallepedido.php?msj=$mensaje");
?>

