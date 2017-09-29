<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/venta.php");

$opcion = $_POST["fenviar"];
$idventa= $_POST["fidventa"];
$fechaventa= $_POST["ffechaventa"];
$idempleadosventa= $_POST["fidempleadosventa"];
$idpedidoventa= $_POST["fidpedidoventa"];


$fechaventa= htmlspecialchars($fechaventa);
$idempleadosventa = htmlspecialchars($idempleadosventa);
$idpedidoventa = htmlspecialchars($idpedidoventa);

$objetoventa= new venta($conexion,$idventa,$fechaventa,$idempleadosventa,$idpedidoventa);

switch($opcion){
    case 'ingresar':
    $objetoventa->insertar();
    $mensaje = "ingresado";
    break;

    case 'modificar':
        $objetoventa->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetoventa->eliminar();
    $mensaje = "eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formularioventa.php?msj=$mensaje");
?>

