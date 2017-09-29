<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/empleados.php");

$opcion = $_POST["fenviar"];
$idempleados= $_POST["fidempleados"];
$nombreempleados= $_POST["fnombreempleados"];
$telefonoempleados= $_POST["ftelefonoempleados"];
$direccionempleados= $_POST["fdireccionempleados"];


$nombreempleados= htmlspecialchars($nombreempleados);
$telefonoempleados = htmlspecialchars($telefonoempleados);
$direcionempleados = htmlspecialchars($direccionempleados);

$objetoempleados= new empleados($conexion,$idempleados,$nombreempleados,$telefonoempleados,$direccionempleados);

switch($opcion){
    case 'ingresar':
    $objetoempleados->insertar();
    $mensaje ="ingresado";
    break;

    case 'modificar':
        $objetoempleados->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetoempleados->eliminar();
    $mensaje ="eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formularioempleados.php?msj=$mensaje");
?>

