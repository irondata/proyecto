<html>
<head></head>
<body>
    <form action="../controlador/controladorlogin.php" method="post">
    <h2>Ingrese al sistema</h2>
        <input name="femail" type="email" maxlength="60" placeholder="nombre@sucorreo.co" required autofocus>
        <input name="fclave" type="password" placeholder="password" required>
        <button name="Enviar" type="submit" value="Ingresar">Ingresar</button>
    </form>
    <?php
    @$mensage =$_GET['mensaje'];
    if(isset($mensaje)){
        if($mensaje=='incorrecto'){
            
            echo '<div class="alert alert-danger" role="alert"> usuario o clave incorrecto</div>';
        }
    }
    ?>
    </body>
</html>