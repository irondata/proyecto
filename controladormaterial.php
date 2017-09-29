<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/material.php");

$opcion = $_POST["fenviar"];
$idmaterial= $_POST["fidmaterial"];
$nombrematerial = $_POST["fnombrematerial"];
$idproveedormaterial= $_POST["fidproveedormaterial"];


$nombrematerial= htmlspecialchars($nombrematerial);
$idproveedormaterial = htmlspecialchars($idproveedormaterial);

$objetomaterial= new material($conexion,$idmaterial,$nombrematerial,$idproveedormaterial);

switch($opcion){
    case 'ingresar':
    $objetomaterial->insertar();
    $mensaje = "ingresado";
    break;

    case 'modificar':
        $objetomaterial->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetomaterial->eliminar();
    $mensaje = "eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formulariomaterial.php?msj=$mensaje");
?>

