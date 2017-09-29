<?php
class auditoria{
    private $_conexion;
    private $_idauditoria;
    private $_fechaauditoria;
    private $_descripcionauditoria;
    private $_idusuarioauditoria;
   
    
    private $_paginacion=10;

    function __construct($conexion,$idauditoria,$fechaauditoria,$descripcionauditoria,$idusuarioauditoria){
        $this->_conexion=$conexion;
        $this->_idauditoria=$idauditoria;
        $this->_fechaauditoria=$fechaauditoria;
        $this->_descripcionauditoria=$descripcionauditoria;
        $this->_idusuarioauditoria=$idusuarioauditoria;
     
      
    }
    
    function __get($k){
        return $this->$k;
    }
    
    function __set($k,$v){
        $this->$k=$v;
    }
    
    function insertar(){
        $insercion=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,fechaauditoria,descripcionauditoria,idusuarioauditoria) VALUES (NULL,'$this->_fechaauditoria','$this->_descripcionauditoria','$this->_idusuarioauditoria')") or die (mysqli_error ($this->_conexion));
    //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
    return $insercion;
    }
    
    function modificar(){
        $modificacion=mysqli_query($this->_conexion,"UPDATE auditoria SET fechaauditoria='$this->_fechaauditoria',descripcionauditoria='$this->_descripcionauditoria',idusuarioauditoria='$this->_idusuarioauditoria' WHERE idauditoria=$this->_idauditoria");
        //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES (NULL,'modifico".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
        return $modificacion;
    }

    function eliminar(){
        $eliminacion =mysqli_query($this->_conexion,"DELETE FROM auditoria
        WHERE idauditoria=$this->_idauditoria");
        //$auditoria=mysqli_query($this->_conexion,"INSERT INTO auditoria(idauditoria,detalleauditoria,idusuarioauditoria,fechaauditoria) VALUES(NULL,'inserto".static::class.",".$_SESSION['idusuario'].",'CURDATE()')");
        return $eliminacion;
    }

    function cantidadpaginas(){
        $cantidadbloques=mysqli_query($this->_conexion,
        "SELECT CEIL(COUNT(idauditoria)/$this->_paginacion) AS cantidad FROM auditoria")
        or die(mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($cantidadbloques);
        return $unregistro['cantidad'];

    }
    
    function listar($pagina){
        if ($pagina<=0){
            $listado = mysqli_query ($this->_conexion,"SELECT * FROM auditoria ORDER BY idauditoria") or
             die(mysqli_error($this->_conexion));
        } else{
            $paginacionmax = $pagina * $this->_paginacion;
            $paginacionmin=$paginacionmax - $this->_paginacion;
            $listado = mysqli_query($this->_conexion,"SELECT * FROM auditoria ORDER BY idauditoria LIMIT $paginacionmin,$paginacionmax");
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