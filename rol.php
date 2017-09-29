<?php
class rol{
    private $_conexion;
    private $_idrol;
    private $_nombrerol;
    private $_elementorol;
    private $_proveedorrol;
    private $_empleadosrol;
    private $_disenorol;
    private $_materialrol;
    private $_pedidorol;
    private $_detallepedidorol;
    private $_ventarol;
    private $_usuariorol;
    private $_auditoriarol;
    private $_rolrol;
   
    
    private $_paginacion=10;

    function __construct($conexion,$idrol,$nombrerol,$elementorol,$proveedorrol,$empleadosrol,$disenorol,$materialrol,$pedidorol,$detallepedidorol,$ventarol,$usuariorol,$auditoriarol,$rolrol){
        $this->_conexion=$conexion;
        $this->_idrol=$idrol;
        $this->_nombrerol=$nombrerol;
        $this->_elementorol=$elementorol;
        $this->_proveedorrol=$proveedorrol;
        $this->_empleadosrol=$empleadosrol;
        $this->_disenorol=$disenorol;
        $this->_materialrol=$materialrol;
        $this->_pedidorol=$pedidorol;
        $this->_detallepedidorol=$detallepedidorol;
        $this->_ventarol=$ventarol;
        $this->_usuariorol=$usuariorol;
        $this->_auditoriarol=$auditoriarol;
        $this->_rolrol=$rolrol;
    }
    
    function __get($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k=$v;
    }
    
function insertar(){
    $insercion=mysqli_query($this->_conexion,"INSERT INTO rol(idrol,nombrerol,elementorol,proveedorrol,empleadosrol,disenorol,materialrol,pedidorol,detallepedidorol,ventarol,usuariorol,auditoriarol,rolrol) VALUES (NULL,'$this->_nombrerol','$this->_elementorol','$this->_proveedorrol','$this->_empleadosrol','$this->_disenorol','$this->_materialrol','$this->_pedidorol','$this->_detallepedidorol','$this->_ventarol','$this->_usuariorol','$this->_auditoriarol','$this->_rolrol')") or die (mysqli_error ($this->_conexion));
//$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
return $insercion;
}
    
function modificar(){
    $modificacion=mysqli_query($this->_conexion,"UPDATE rol SET nombrerol='$this->_nombrerol',elementorol='$this->_elementorol',proveedorrol='$this->_proveedorrol',empleadosrol='$this->_empleadosrol',disenorol='$this->_disenorol',materialrol='$this->_materialrol',pedidorol='$this->_pedidorol',detallepedidorol='$this->_detallepedidorol',ventarol='$this->_ventarol',usuariorol='$this->_usuariorol',auditoriarol='$this->_auditoriarol',rolrol='$this->_rolrol' WHERE idrol=$this->_idrol");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'modifico".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $modificacion;
}

function eliminar(){
    $eliminacion =mysqli_query($this->_conexion,"DELETE FROM rol
    WHERE idrol$this->_idrol");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $eliminacion;
}


function cantidadpaginas(){
    $cantidadbloques=mysqli_query($this->_conexion,
    "SELECT CEIL(COUNT(idrol)/$this->_paginacion) AS cantidad FROM rol")
    or die(mysqli_error($this->_conexion));
    $unregistro=mysqli_fetch_array($cantidadbloques);
    return $unregistro['cantidad'];

}
function listar($pagina){
    if ($pagina<=0){
        $listado = mysqli_query ($this->_conexion,"SELECT * FROM rol ORDER BY idrol") or
         die(mysqli_error($this->_conexion));

    } else{
$paginacionmax = $pagina * $this->_paginacion;
$paginacionmin=$paginacionmax - $this->_paginacion;
$listado = mysqli_query($this->_conexion,"SELECT * FROM rol ORDER BY idrol
LIMIT  $paginacionmin,$paginacionmax");

    }
    return $listado;
}
      function getpermiso($idusuario){

         $permiso=mysqli_query($this->_conexion,"SELECT ".static::class."rol AS elpermiso FROM rol WHERE idrol IN(SELECT idrolusuario FROM usuario WHERE idrolusuario=$idusuario)") or die(mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($permiso);
        return $unregistro["elpermiso"];
    }
    
}
?>