<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/proveedor.php");

$opcion = $_POST["fenviar"];
$idproveedor= $_POST["fidproveedor"];
$nombreproveedor= $_POST["fnombreproveedor"];
$celularproveedor= $_POST["fcelularproveedor"];
$direccionproveedor= $_POST["fdireccionproveedor"];


$nombreproveedor= htmlspecialchars($nombreproveedor);
$celularproveedor = htmlspecialchars($celularproveedor);
$direcionproveedor = htmlspecialchars($direccionproveedor);

$objetoproveedor= new proveedor($conexion,$idproveedor,$nombreproveedor,$celularproveedor,$direccionproveedor);

switch($opcion){
    case 'ingresar':
    $objetoproveedor->insertar();
    $mensaje = "ingresado";
    break;

    case 'modificar':
        $objetoproveedor->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetoproveedor->eliminar();
    $mensaje = "eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formularioproveedor.php?msj=$mensaje");
?>

