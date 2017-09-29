<?php
class login{
    private $_conexion;
    private $_idusuario;
    private $_emailusuario;
    private $_hashedclaveusuario;
    private $_nombreusuario;
    private $_rolusuario;
    
    function __construct($conexion,$correo,$clave){
        
        $this->_conexion    = $conexion;
        $this->_emailusuario    = $correo;
        $this->_hashedclaveusuario   = hash('sha256',$clave);
    }
    
    
    function verificarusuario(){
        
        $verificacion = mysqli_query($this->_conexion,"SELECT idusuario,nombreusuario,idrolusuario FROM usuario WHERE emailusuario LIKE '$this->_emailusuario' AND CONVERT(claveusuario, CHAR(100)) LIKE '$this->_hashedclaveusuario'");
        
        echo "SELECT idusuario,nombreusuario,idrolusuario FROM usuario WHERE emailusuario LIKE '$this->_emailusuario' AND CONVERT(claveusuario, CHAR(100)) LIKE '$this->_hashedclaveusuario'";
        
        if(mysqli_num_rows($verificacion)){
            $unusuario =mysqli_fetch_array($verificacion);
            $this->_idusuario =$unusuario["idusuario"];
            $this->_nombreusuario =$unusuario["nombreusuario"];
            $this->_rolusuario =$unusuario["idrolusuario"];
            return true;    
        }
        return false;
    }
    function getidusuario(){
        return $this->_idusuario;
    }
    function getnombreusuario(){
         return $this->_nombreusuario;
    }
   function getrolusuario(){
       return $this->_rolusuario;
   } 
}
?>