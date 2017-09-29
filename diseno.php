<?php
class diseno{
    private $_conexion;
    private $_iddiseno;
    private $_rutadiseno;
    private $_idmaterialdiseno;
   
    
    private $_paginacion=10;

    function __construct($conexion,$iddiseno,$rutadiseno,$idmaterialdiseno){
        $this->_conexion=$conexion;
        $this->_iddiseno=$iddiseno;
        $this->_rutadiseno=$rutadiseno;
        $this->_idmaterialdiseno=$idmaterialdiseno;
     
      
    }
    
    function __get($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k=$v;
    }
    
function insertar(){
    $insercion=mysqli_query($this->_conexion,"INSERT INTO diseno(iddiseno,rutadiseno,idmaterialdiseno) VALUES (NULL,'$this->_rutadiseno','$this->_idmaterialdiseno')") or die (mysqli_error ($this->_conexion));
//$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
return $insercion;
}
    
function modificar(){
    $modificacion=mysqli_query($this->_conexion,"UPDATE diseno SET rutadiseno='$this->_rutadiseno',idmaterialdiseno='$this->_idmaterialdiseno' WHERE iddiseno=$this->_iddiseno") or die (mysqli_error ($this->_conexion));
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'modifico".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $modificacion;
}

function eliminar(){
    $eliminacion =mysqli_query($this->_conexion,"DELETE FROM diseno
    WHERE iddiseno=$this->_iddiseno");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $eliminacion;
}

function cantidadpaginas(){
    $cantidadbloques=mysqli_query($this->_conexion,
    "SELECT CEIL(COUNT(iddiseno)/$this->_paginacion) AS cantidad FROM diseno")
    or die(mysqli_error($this->_conexion));
    $unregistro=mysqli_fetch_array($cantidadbloques);
    return $unregistro['cantidad'];

}
function listar($pagina){
    if ($pagina<=0){
        $listado = mysqli_query ($this->_conexion,"SELECT * FROM diseno ORDER BY iddiseno") or
         die(mysqli_error($this->_conexion));

    } else{
$paginacionmax = $pagina * $this->_paginacion;
$paginacionmin=$paginacionmax - $this->_paginacion;
$listado = mysqli_query($this->_conexion,"SELECT * FROM diseno ORDER BY iddiseno
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