<?php
session_start();
  if(isset($_SESSION["logado"])) {
    header("location: home.php");
  }

?>

<link rel="stylesheet" type="text/css" href="html_css/css.css" />

<?php

include_once "html_css/header.php";
include_once "conexao.php";

if(isset($_POST["entrar"])) {
  $nome = mysqli_escape_string($connect,$_POST["nome"]);
  $email = mysqli_escape_string($connect,$_POST["email"]);
  $login = mysqli_escape_string($connect,$_POST["login"]);
  $senha = mysqli_escape_string($connect,$_POST["senha"]);
  $confirme = mysqli_escape_string($connect,$_POST["confirmacao-senha"]);
  $erros = [];
  
  if(empty($login) or empty($senha) or empty($email) or  empty($confirme) or empty($nome)) {
    $erros[] = "<li>Preencha os dados Corretamente</li>";
  } else {
    $sql = "SELECT Login FROM usuarios WHERE Login = '$login'";
    $resultado = mysqli_query($connect,$sql);
    if(mysqli_num_rows($resultado)> 0) {
      $erros[] = "<li>Esse login ja existe</li>";
    } else {
      $sql = "SELECT Email FROM usuarios WHERE Email = '$email'";
    $resultado = mysqli_query($connect,$sql); 
      if(mysqli_num_rows($resultado)> 0) {
        $erros[] = "<li> Esse Email ja existe </li>";
      } else {
        $senha = md5($senha);
        $confirme = md5($confirme);
        if($senha === $confirme) {
            $sql = "INSERT INTO `usuarios` (`Nome`, `Login`, `Senha`, `Email`) VALUES ( '$nome', '$login', '$senha', '$email'); ";
            $resultado = mysqli_query($connect,$sql);
            $criado = true;
        } else {
          $erros[] = "<li>Senhas são diferentes</li>";
        }
      }
    }

  }

}

?>

<div class="formulario">
    <h1>Crie a Sua conta</h1> <br>
<form action="" method="post">
<div class="mb-3">
  <label for="Nome" class="form-label">Digite seu Nome</label>
  <input type="text" class="form-control" id="Nome" name="nome" autocomplete="off">
</div>
<div class="mb-3">
<label for="login" class="form-label">Login</label>
  <input type="text" class="form-control" id="login" name="login" autocomplete="off">
</div>
<div class="mb-3">
  <label for="email" class="form-label">Email</label>
  <input type="email" class="form-control" id="email" name="email" autocomplete="off">
  <div class="mb-3">
    <label for="Senha" class="form-label">Digite sua Senha</label>
    <input type="password" class="form-control" id="Senha" name="senha" autocomplete="off">
  </div>
  <div class="mb-3">
    <label for="confirmacao-senha" class="form-label">Confirme sua Senha</label> 
    <input type="password" class="form-control" id="confirmacao-senha" name="confirmacao-senha" autocomplete="off">


  </div>
  
</div>  
<button type="submit" class="btn btn-primary" name="entrar">Cadastrar</button> <br>  <br>

<?php
                if(isset($criado)) {
                        ?>
                        <div class="alert alert-success" role="alert">
                       <?php  echo "Usuario criado com scesso"; ?>
                      </div>
                      <?php
                } 
?>

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



</form>



<?php
include_once "html_css/footer.php";
 ?>