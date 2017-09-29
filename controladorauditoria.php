<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/auditoria.php");

$opcion = $_POST["fenviar"];
$idauditoria= $_POST["fidauditoria"];
$fechaauditoria = $_POST["ffechaauditoria"];
$descripcionauditoria = $_POST["fdescripcionauditoria"];
$idusuarioauditoria= $_POST["fidusuarioauditoria"];


$fechaauditoria= htmlspecialchars($fechaauditoria);
$descripcionauditoria= htmlspecialchars($descripcionauditoria);
$idusuarioauditoria = htmlspecialchars($idusuarioauditoria);

$objetoauditoria= new auditoria($conexion,$idauditoria,$fechaauditoria,$descripcionauditoria,$idusuarioauditoria);

switch($opcion){
    case 'ingresar':
    $objetoauditoria->insertar();
    $mensaje = "ingresado";
    break;

    case 'modificar':
        $objetoauditoria->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetoauditoria->eliminar();
    $mensaje = "eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formularioauditoria.php?msj=$mensaje");
?>

