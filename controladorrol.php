<?php
include_once("../modelo/conexion.php");
$objetoconexion = new conexion();
$conexion = $objetoconexion->conectar();

include_once("../modelo/rol.php");

$opcion = $_POST["fenviar"];
$idrol= $_POST["fidrol"];
$nombrerol= $_POST["fnombrerol"];
$elementorol= $_POST["felementorol"];
$proveedorrol= $_POST["fproveedorrol"];
$empleadosrol= $_POST["fempleadosrol"];
$disenorol= $_POST["fdisenorol"];
$materialrol= $_POST["fmaterialrol"];
$pedidorol= $_POST["fpedidorol"];
$detallepedidorol= $_POST["fdetallepedidorol"];
$ventarol= $_POST["fventarol"];
$usuariorol= $_POST["fusuariorol"];
$auditoriarol= $_POST["fauditoriarol"];
$rolrol= $_POST["frolrol"];

$nombrerol= htmlspecialchars($nombrerol);
$elementorol = htmlspecialchars($elementorol);
$proveedorrol = htmlspecialchars($proveedorrol);
$empleadosrol= htmlspecialchars($empleadosrol);
$disenorol = htmlspecialchars($disenorol);
$materialrol= htmlspecialchars($materialrol);
$pedidorol= htmlspecialchars($pedidorol);
$detallepediorol= htmlspecialchars($detallepedidorol);
$ventarol= htmlspecialchars($ventarol);
$usuariorol= htmlspecialchars($usuariorol);
$auditoriarol= htmlspecialchars($auditoriarol);
$rolrol= htmlspecialchars($rolrol);

$objetorol= new rol($conexion,$idrol,$nombrerol,$elementorol,$proveedorrol,$empleadosrol,$disenorol,$materialrol,$pedidorol,$detallepedidorol,$ventarol,$usuariorol,$auditoriarol,$rolrol);

switch($opcion){
    case 'ingresar':
    $objetorol->insertar();
    $mensaje = "ingresado";
    break;

    case 'modificar':
        $objetorol->modificar();
        $mensaje="modificado";
    break;
        
    case 'eliminar':
    $objetorol->eliminar();
    $mensaje = "eliminado";
    break;

}
$objetoconexion->desconectar($conexion);
header("location:../vista/formulariorol.php?msj=$mensaje");
?>

