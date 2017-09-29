
<?php
$emailusuario = $_POST["femail"];
$claveusuario = $_POST["fclave"];

include_once("../modelo/conexion.php");
$objetoconexion =new conexion();
$conexion = $objetoconexion->conectar();

$emailusuario =mysqli_real_escape_string($conexion, $emailusuario);

include_once("../modelo/login.php");
$objetologin = new login($conexion,$emailusuario, $claveusuario);
$usuarioesvalido = $objetologin->verificarusuario();

$objetoconexion->desconectar($conexion);
if($usuarioesvalido==true){
    session_start();
    $_SESSION['id']     = $objetologin->getidusuario();
    $_SESSION['nombre'] = $objetologin->getnombreusuario();
    $_SESSION['rol']    = $objetologin->getrolusuario();
    header("location:../vista/formulariopedido.php");
}else{

   header("location:../vista/formulariologin.php?mensaje=incorrecto");
    
}   
?>    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 