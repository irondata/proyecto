<?php
class cliente{
    private $_conexion;
    private $_idcliente;
    private $_nombrecliente;
    private $_telefonocliente;
    private $_direccioncliente;
    private $_fecharegistrocliente;
    private $_paginacion=10;

    function __construct($conexion,$idcliente,$nombrecliente,$telefonocliente,$direccioncliente,$fecharegistrocliente){
        $this->_conexion=$conexion;
        $this->_idcliente=$idcliente;
        $this->_nombrecliente=$nombrecliente;
        $this->_telefonocliente=$telefonocliente;
        $this->_direccioncliente=$direccioncliente;
        $this->_fecharegistrocliente=$fecharegistrocliente;
    }
    
    function __get($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k=$v;
    }
    
function insertar(){
    $insercion=mysqli_query($this->_conexion,"INSERT INTO cliente(idcliente,nombrecliente,telefonocliente,direccioncliente,fecharegistrocliente) VALUES (NULL,'$this->_nombrecliente','$this->_telefonocliente','$this->_direccioncliente','$this->_fecharegistrocliente')") or die (mysqli_error ($this->_conexion));
//$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
return $insercion;
}
    
function modificar(){
    $modificacion=mysqli_query($this->_conexion,"UPDATE cliente  SET nombrecliente='$this->_nombrecliente',telefonocliente='$this->_telefonocliente',direccioncliente='$this->_direccioncliente',fecharegistrocliente='$this->_fecharegistrocliente' WHERE idcliente=$this->_idcliente");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'modifico".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $modificacion;
}

function eliminar(){
    $eliminacion =mysqli_query($this->_conexion,"DELETE FROM cliente
    WHERE idcliente=$this->_idcliente");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $eliminacion;
}

function cantidadpaginas(){
    $cantidadbloques=mysqli_query($this->_conexion,
    "SELECT CEIL(COUNT(idcliente)/$this->_paginacion) AS cantidad FROM cliente")
    or die(mysqli_error($this->_conexion));
    $unregistro=mysqli_fetch_array($cantidadbloques);
    return $unregistro['cantidad'];

}
function listar($pagina){
    if ($pagina<=0){
        $listado = mysqli_query ($this->_conexion,"SELECT * FROM cliente ORDER BY idcliente") or
         die(mysqli_error($this->_conexion));

    } else{
$paginacionmax = $pagina * $this->_paginacion;
$paginacionmin=$paginacionmax - $this->_paginacion;
$listado = mysqli_query($this->_conexion,"SELECT * FROM cliente ORDER BY idcliente
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