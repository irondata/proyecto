<?php
class venta{
    private $_conexion;
    private $_idventa;
    private $_fechaventa;
    private $_idempleadosventa;
    private $_idpedidoventa;
   
    
    private $_paginacion=10;

    function __construct($conexion,$idventa,$fechaventa,$idempleadosventa,$idpedidoventa){
        $this->_conexion=$conexion;
        $this->_idventa=$idventa;
        $this->_fechaventa=$fechaventa;
        $this->_idempleadosventa=$idempleadosventa;
        $this->_idpedidoventa=$idpedidoventa;
     
      
    }
    
    function __get($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k=$v;
    }
    
function insertar(){
    $insercion=mysqli_query($this->_conexion,"INSERT INTO venta(idventa,fechaventa,idempleadosventa,idpedidoventa) VALUES (NULL,'$this->_fechaventa','$this->_idempleadosventa','$this->_idpedidoventa')") or die (mysqli_error ($this->_conexion));
//$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
return $insercion;
}
    
function modificar(){
    $modificacion=mysqli_query($this->_conexion,"UPDATE venta SET fechaventa='$this->_fechaventa',idempleadosventa='$this->_idempleadosventa',idpedidoventa='$this->_idpedidoventa' WHERE idventa=$this->_idventa");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'modifico".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $modificacion;
}

function eliminar(){
    $eliminacion =mysqli_query($this->_conexion,"DELETE FROM venta
    WHERE idventa=$this->_idventa");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $eliminacion;
}

function cantidadpaginas(){
    $cantidadbloques=mysqli_query($this->_conexion,
    "SELECT CEIL(COUNT(idventa)/$this->_paginacion) AS cantidad FROM venta")
    or die(mysqli_error($this->_conexion));
    $unregistro=mysqli_fetch_array($cantidadbloques);
    return $unregistro['cantidad'];

}
function listar($pagina){
    if ($pagina<=0){
        $listado = mysqli_query ($this->_conexion,"SELECT * FROM venta ORDER BY idventa") or
         die(mysqli_error($this->_conexion));

    } else{
$paginacionmax = $pagina * $this->_paginacion;
$paginacionmin=$paginacionmax - $this->_paginacion;
$listado = mysqli_query($this->_conexion,"SELECT * FROM venta ORDER BY idventa
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