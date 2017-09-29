<?php
class usuario{
    private $_conexion;
    private $_idusuario;
    private $_nombreusuario;
    private $_emailusuario;
    private $_claveusuario;
    private $_fecharegistrousuario;
    private $_fechaultimaclaveusuario;
    private $_idrolusuario;
  
   
    
    private $_paginacion=10;

    function __construct($conexion,$idusuario,$nombreusuario,$emailusuario,$claveusuario,$fecharegistrousuario,$fechaultimaclaveusuario,$idrolusuario){
        $this->_conexion=$conexion;
        $this->_idusuario=$idusuario;
        $this->_nombreusuario=$nombreusuario;
        $this->_emailusuario=$emailusuario;
        $this->_claveusuario=$claveusuario;
        $this->_fecharegistrousuario=$fecharegistrousuario;
        $this->_fechaultimaclaveusuario=$fechaultimaclaveusuario;
        $this->_idrolusuario=$idrolusuario;
       
    }
    
    function __get($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k=$v;
    }
    
function insertar(){
    $insercion=mysqli_query($this->_conexion,"INSERT INTO  usuario(idusuario,nombreusuario,emailusuario,claveusuario,fecharegistrousuario,fechaultimaclaveusuario,idrolusuario) VALUES (NULL,'$this->_nombreusuario','$this->_emailusuario','".hash('sha256',$this->_claveusuario)."','$this->_fecharegistrousuario','$this->_fechaultimaclaveusuario','$this->_idrolusuario')") or die (mysqli_error ($this->_conexion));
//$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
return $insercion;
}
    
function modificar(){
    $modificacion=mysqli_query($this->_conexion,"UPDATE usuario SET nombreusuario='$this->_nombreusuario',emailusuario='$this->_emailusuario',claveusuario='$this->_claveusuario',fecharegistrousuario='$this->_fecharegistrousuario',fechaultimaclaveusuario='$this->_fechaultimaclaveusuario',idrolusuario='$this->_idrolusuario' WHERE idusuario=$this->_idusuario");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'modifico".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $modificacion;
}

function eliminar(){
    $eliminacion =mysqli_query($this->_conexion,"DELETE FROM usuario
    WHERE idusuario=$this->_idusuario");
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $eliminacion;
}


function cantidadpaginas(){
    $cantidadbloques=mysqli_query($this->_conexion,
    "SELECT CEIL(COUNT(idusuario)/$this->_paginacion) AS cantidad FROM usuario")
    or die(mysqli_error($this->_conexion));
    $unregistro=mysqli_fetch_array($cantidadbloques);
    return $unregistro['cantidad'];

}
function listar($pagina){
    if ($pagina<=0){
        $listado = mysqli_query ($this->_conexion,"SELECT * FROM usuario ORDER BY idusuario") or
         die(mysqli_error($this->_conexion));

    } else{
$paginacionmax = $pagina * $this->_paginacion;
$paginacionmin=$paginacionmax - $this->_paginacion;
$listado = mysqli_query($this->_conexion,"SELECT * FROM usuario ORDER BY idusuario
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