<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/diseno.php");

$opcion = $_POST["fenviar"];
$iddiseno= $_POST["fiddiseno"];
$rutadiseno = $_POST["frutadiseno"];
$idmaterialdiseno= $_POST["fidmaterialdiseno"];


$rutadiseno= htmlspecialchars($rutadiseno);
$idmaterialdiseno = htmlspecialchars($idmaterialdiseno);

$objetodiseno= new diseno($conexion,$iddiseno,$rutadiseno,$idmaterialdiseno);

switch($opcion){
    case 'ingresar':
    $objetodiseno->insertar();
    $mensaje = "ingresado";
    break;

    case 'modificar':
        $objetodiseno->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetodiseno->eliminar();
    $mensaje = "eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formulariodiseno.php?msj=$mensaje");
?>

