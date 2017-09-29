<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/cliente.php");

$opcion = $_POST["fenviar"];
$idcliente= $_POST["fidcliente"];
$nombrecliente = $_POST["fnombrecliente"];
$telefonocliente= $_POST["ftelefonocliente"];
$direccioncliente= $_POST["fdireccioncliente"];
$fecharegistrocliente= $_POST["ffecharegistrocliente"];


$nombrecliente= htmlspecialchars($nombrecliente);
$telefonocliente = htmlspecialchars($telefonocliente);
$direccioncliente = htmlspecialchars($direccioncliente);
$fecharegistrocliente = htmlspecialchars($fecharegistrocliente);


$objetocliente= new cliente($conexion,$idcliente,$nombrecliente,$telefonocliente,$direccioncliente,$fecharegistrocliente);

switch($opcion){
    case 'ingresar':
    $objetocliente->insertar();
    $mensaje = "ingresado";
    break;

    case 'modificar':
        $objetocliente->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetocliente->eliminar();
    $mensaje = "eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formulariocliente.php?msj=$mensaje");
?>

