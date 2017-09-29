<?php
class empleados{
    private $_conexion;
    private $_idempleados;
    private $_nombreempleados;
    private $_telefonoempleados;
    private $_direccionempleados;
    
  
    
    private $_paginacion=10;

    function __construct($conexion,$idempleados,$nombreempleados,$telefonoempleados,$direccionempleados){
        $this->_conexion=$conexion;
        $this->_idempleados=$idempleados;
        $this->_nombreempleados=$nombreempleados;
        $this->_telefonoempleados=$telefonoempleados;
        $this->_direccionempleados=$direccionempleados;
        
       
    }
    
    function __get($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k=$v;
    }
    
function insertar(){
    $insercion=mysqli_query($this->_conexion,"INSERT INTO empleados(idempleados,nombreempleados,telefonoempleados,direccionempleados) VALUES (NULL,'$this->_nombreempleados','$this->_telefonoempleados','$this->_direccionempleados')") or die (mysqli_error ($this->_conexion));
//$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
return $insercion;
}
    
function modificar(){
    $modificacion=mysqli_query($this->_conexion,"UPDATE empleados SET nombreempleados='$this->_nombreepleados',telefonoempleados='$this->_telefonoempleados',direccionempleados='$this->_direccionempleados' WHERE idempleados=$this->_idempleados");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'modifico".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $modificacion;
}

function eliminar(){
    $eliminacion=mysqli_query($this->_conexion,"DELETE FROM empleados
    WHERE idempleados=$this->_idempleados")or die (mysqli_error ($this->_conexion));
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $eliminacion;
}


function cantidadpaginas(){
    $cantidadbloques=mysqli_query($this->_conexion,
    "SELECT CEIL(COUNT(idempleados)/$this->_paginacion) AS cantidad FROM empleados")
    or die(mysqli_error($this->_conexion));
    $unregistro=mysqli_fetch_array($cantidadbloques);
    return $unregistro['cantidad'];

}
function listar($pagina){
    if ($pagina<=0){
        $listado = mysqli_query ($this->_conexion,"SELECT * FROM empleados ORDER BY idempleados") or
         die(mysqli_error($this->_conexion));

    } else{
$paginacionmax = $pagina * $this->_paginacion;
$paginacionmin=$paginacionmax - $this->_paginacion;
$listado = mysqli_query($this->_conexion,"SELECT * FROM empleados ORDER BY idempleados
LIMIT  $paginacionmin,$paginacionmax");

    }
    return $listado;
} function getpermiso($idusuario){

         $permiso=mysqli_query($this->_conexion,"SELECT ".static::class."rol AS elpermiso FROM rol WHERE idrol IN(SELECT idrolusuario FROM usuario WHERE idrolusuario=$idusuario)") or die(mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($permiso);
        return $unregistro["elpermiso"];
    }
    
}
?>