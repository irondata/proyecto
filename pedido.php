<?php
class pedido{
    private $_conexion;
    private $_idpedido;
    private $_fechapedido;
    private $_valorpedido;
    private $_idclientepedido;
   
    
    private $_paginacion=10;

    function __construct($conexion,$idpedido,$fechapedido,$valorpedido,$idclientepedido){
        $this->_conexion=$conexion;
        $this->_idpedido=$idpedido;
        $this->_fechapedido=$fechapedido;
        $this->_valorpedido=$valorpedido;
        $this->_idclientepedido=$idclientepedido;
     
      
    }
    
    function __get($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k=$v;
    }
    
function insertar(){
    $insercion=mysqli_query($this->_conexion,"INSERT INTO pedido(idpedido,fechapedido,valorpedido,idclientepedido) VALUES (NULL,'$this->_fechapedido','$this->_valorpedido','$this->_idclientepedido')") or die (mysqli_error ($this->_conexion));
//$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
return $insercion;
}
    
function modificar(){
    $modificacion=mysqli_query($this->_conexion,"UPDATE pedido SET fechapedido='$this->_fechapedido',valorpedido='$this->_valorpedido',idclientepedido='$this->_idclientepedido' WHERE idpedido=$this->_idpedido");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'modifico".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $modificacion;
}

function eliminar(){
    $eliminacion =mysqli_query($this->_conexion,"DELETE FROM pedido
    WHERE idpedido=$this->_idpedido");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $eliminacion;
}

function cantidadpaginas(){
    $cantidadbloques=mysqli_query($this->_conexion,
    "SELECT CEIL(COUNT(idpedido)/$this->_paginacion) AS cantidad FROM pedido")
    or die(mysqli_error($this->_conexion));
    $unregistro=mysqli_fetch_array($cantidadbloques);
    return $unregistro['cantidad'];

}
function listar($pagina){
    if ($pagina<=0){
        $listado = mysqli_query ($this->_conexion,"SELECT * FROM pedido ORDER BY idpedido") or
         die(mysqli_error($this->_conexion));

    } else{
$paginacionmax = $pagina * $this->_paginacion;
$paginacionmin=$paginacionmax - $this->_paginacion;
$listado = mysqli_query($this->_conexion,"SELECT * FROM pedido ORDER BY idpedido
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