<?php
class detallepedido{
    private $_conexion;
    private $_iddetallepedido;
    private $_cantidaddepedidodetallepedido;
    private $_idpedidodetallepedido;
    private $_iddisenodetallepedido;
    
    private $_paginacion=10;

    function __construct($conexion,$iddetallepedido,$cantidaddepedidodetallepedido,$idpedidodetallepedido,$iddisenodetallepedido){
        $this->_conexion=$conexion;
        $this->_iddetallepedido=$iddetallepedido;
        $this->_cantidaddepedidodetallepedido=$cantidaddepedidodetallepedido;
        $this->_idpedidodetallepedido=$idpedidodetallepedido;
        $this->_iddisenodetallepedido=$iddisenodetallepedido;
    
      
    }
    
    function __get($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k=$v;
    }
    
function insertar(){
    $insercion=mysqli_query($this->_conexion,"INSERT INTO detallepedido(iddetallepedido,cantidaddepedidodetallepedido,idpedidodetallepedido,iddisenodetallepedido) VALUES (NULL,'$this->_cantidaddepedidodetallepedido','$this->_idpedidodetallepedido','$this->_iddisenodetallepedido')") or die (mysqli_error ($this->_conexion));
//$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
return $insercion;
}
    
function modificar(){
    $modificacion=mysqli_query($this->_conexion,"UPDATE detallepedido SET cantidaddepedidodetallepedido='$this->_cantidaddepedidodetallepedido',idpedidodetallepedido='$this->_idpedidodetallepedido',iddisenodetallepedido='$this->_iddisenodetallepedido' WHERE iddetallepedido=$this->_iddetallepedido");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'modifico".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $modificacion;
}

function eliminar(){
    $eliminacion =mysqli_query($this->_conexion,"DELETE FROM detallepedido
    WHERE iddetallepedido=$this->_iddetallepedido");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $eliminacion;
}

function cantidadpaginas(){
    $cantidadbloques=mysqli_query($this->_conexion,
    "SELECT CEIL(COUNT(iddetallepedido)/$this->_paginacion) AS cantidad FROM detallepedido")
    or die(mysqli_error($this->_conexion));
    $unregistro=mysqli_fetch_array($cantidadbloques);
    return $unregistro['cantidad'];

}
function listar($pagina){
    if ($pagina<=0){
        $listado = mysqli_query ($this->_conexion,"SELECT * FROM detallepedido ORDER BY iddetallepedido") or
         die(mysqli_error($this->_conexion));

    } else{
$paginacionmax = $pagina * $this->_paginacion;
$paginacionmin=$paginacionmax - $this->_paginacion;
$listado = mysqli_query($this->_conexion,"SELECT * FROM detallepedido ORDER BY iddetallepedido
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