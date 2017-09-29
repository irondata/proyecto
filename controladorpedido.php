<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/pedido.php");

$opcion = $_POST["fenviar"];
$idpedido= $_POST["fidpedido"];
$fechapedido = $_POST["ffechapedido"];
$valorpedido= $_POST["fvalorpedido"];
$idclientepedido= $_POST["fidclientepedido"];


$fechapedido= htmlspecialchars($fechapedido);
$valorpedido = htmlspecialchars($valorpedido);
$idclientepedido = htmlspecialchars($idclientepedido);

$objetopedido= new pedido($conexion,$idpedido,$fechapedido,$valorpedido,$idclientepedido);

switch($opcion){
    case 'ingresar':
    $objetopedido->insertar();
    $mensaje = "ingresado";
    break;

    case 'modificar':
        $objetopedido->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetopedido->eliminar();
    $mensaje = "eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formulariopedido.php?msj=$mensaje");
?>

