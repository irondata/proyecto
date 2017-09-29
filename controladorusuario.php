<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/usuario.php");

$opcion = $_POST["fenviar"];
$idusuario= $_POST["fidusuario"];
$nombreusuario= $_POST["fnombreusuario"];
$emailusuario= $_POST["femailusuario"];
$claveusuario= $_POST["fclaveusuario"];
$fecharegistrousuario= $_POST["ffecharegistrousuario"];
$fechaultimaclaveusuario=$_POST["ffechaultimaclaveusuario"];
$idrolusuario= $_POST["fidrolusuario"];

$nombreusuario= htmlspecialchars($nombreusuario);
$emailusuario = htmlspecialchars($emailusuario);
$claveusuario = htmlspecialchars($claveusuario);
$fecharegistrousuario = htmlspecialchars($fecharegistrousuario);
$fechaultimaclaveusuario = htmlspecialchars($fechaultimaclaveusuario);
$idrolusuario = htmlspecialchars($idrolusuario);

$objetousuario= new usuario($conexion,$idusuario,$nombreusuario,$emailusuario,$claveusuario,$fecharegistrousuario,$fechaultimaclaveusuario,$idrolusuario);

switch($opcion){
    case 'ingresar':
    $objetousuario->insertar();
    $mensaje = "ingresado";
    break;

    case 'modificar':
        $objetousuario->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetousuario->eliminar();
    $mensaje = "eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formulariousuario.php?msj=$mensaje");
?>

