<?php
class proveedor{
    private $_conexion;
    private $_idproveedor;
    private $_nombreproveedor;
    private $_celularproveedor;
    private $_direccionproveedor;
   
    
    private $_paginacion=10;

    function __construct($conexion,$idproveedor,$nombreproveedor,$celularproveedor,$direccionproveedor){
        $this->_conexion=$conexion;
        $this->_idproveedor=$idproveedor;
        $this->_nombreproveedor=$nombreproveedor;
        $this->_celularproveedor=$celularproveedor;
        $this->_direccionproveedor=$direccionproveedor;
     
      
    }
    
    function __get($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k=$v;
    }
    
function insertar(){
    $insercion=mysqli_query($this->_conexion,"INSERT INTO proveedor(idproveedor,nombreproveedor,celularproveedor,direccionproveedor) VALUES (NULL,'$this->_nombreproveedor','$this->_celularproveedor','$this->_direccionproveedor')") or die (mysqli_error ($this->_conexion));
//$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
return $insercion;
}
    
function modificar(){
    $modificacion=mysqli_query($this->_conexion,"UPDATE proveedor SET nombreproveedor='$this->_nombreproveedor',celularproveedor='$this->_celularproveedor',direccionproveedor='$this->_direccionproveedor' WHERE idproveedor=$this->_idproveedor");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'modifico".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $modificacion;
}

function eliminar(){
    $eliminacion =mysqli_query($this->_conexion,"DELETE FROM proveedor
    WHERE idproveedor=$this->_idproveedor");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $eliminacion;
}

function cantidadpaginas(){
    $cantidadbloques=mysqli_query($this->_conexion,
    "SELECT CEIL(COUNT(idproveedor)/$this->_paginacion) AS cantidad FROM proveedor")
    or die(mysqli_error($this->_conexion));
    $unregistro=mysqli_fetch_array($cantidadbloques);
    return $unregistro['cantidad'];

}
function listar($pagina){
    if ($pagina<=0){
        $listado = mysqli_query ($this->_conexion,"SELECT * FROM proveedor ORDER BY idproveedor") or
         die(mysqli_error($this->_conexion));

    } else{
$paginacionmax = $pagina * $this->_paginacion;
$paginacionmin=$paginacionmax - $this->_paginacion;
$listado = mysqli_query($this->_conexion,"SELECT * FROM proveedor ORDER BY idproveedor
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