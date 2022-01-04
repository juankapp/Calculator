<link rel="stylesheet" type="text/css" href="html_css/css.css" />

<?php
include_once "html_css/header.php";
include_once "conexao.php";
session_start();

if(isset($_SESSION["logado"])) {
  header("location: home.php");
 }

if(isset($_POST["enviar"])) {
    $erros = [];
    $login = mysqli_escape_string($connect,$_POST["login"]);
    $email = mysqli_escape_string($connect,$_POST["email"]);
    $senha = mysqli_escape_string($connect,$_POST["senha"]);

    if(empty($login) or empty($email) or empty($senha)) {
        $erros[] = "<li>Preencha os campos corretamente</li>";
    } else {
        $sql = "SELECT Login, Email FROM usuarios WHERE Login='$login' and Email ='$email'";
        $resultado = mysqli_query($connect,$sql);
        $senha = md5($senha);
        if(mysqli_num_rows($resultado) > 0 ) {
                    $sql= "UPDATE `usuarios` SET `Senha` = '$senha' WHERE `usuarios`.`Email` = '$email'";
                    $resultado = mysqli_query($connect,$sql);
                    $redefinido = true;
        }else {
            $erros[] = "<li>Login e senha não são compativeis</li>";
        }
    }
    
}


?>

<div class="formulario">
    <h1>Esqueci minha senha</h1> <br>
<form action="" method="post">

<div class="mb-3">
<label for="email" class="form-label" autocomplete="off">Digite seu Email</label>
  <input type="email" class="form-control" id="email" name="email" autocomplete="off">
</div>
<div class="mb-3">
<label for="login" class="form-label">Digite seu Login</label>
  <input type="text" class="form-control" id="login" name="login" autocomplete="off">
</div>
<div class="mb-3">
<label for="senha" class="form-label">Digite sua nova Senha</label>
  <input type="password" class="form-control" id="senha" name="senha" autocomplete="off">
</div>
 
  <button type="submit" class="btn btn-success" name="enviar">Redefinir</button> 

  <?php
                if(isset($redefinido)) {
                        ?>
                        <div class="alert alert-success" role="alert">
                       <?php echo "Senha redefinida"; ?>
                      </div>
                      <?php
                    
                }
            
            
  ?>
  
  <br> <br>

  <div class="container">
    <div class="row">
        <div class="col">
            <?php
                if(!empty($erros)) {
                    foreach($erros as $erro) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                       <?php echo $erro; ?>
                      </div>
                      <?php
                    }
                }
            
            
            ?>

        </div>
    </div>
</div>





 
  </div>
  
  
</div>  

</div>

 



</form>


<?php
include_once "html_css/footer.php";