<link rel="stylesheet" type="text/css" href="html_css/css.css" />

<?php
include_once "html_css/header.php";
include_once "conexao.php";
session_start();

if(isset($_SESSION["logado"])) {
 header("location: home.php");
}

if(isset($_POST["esquecer"])) {
    header("location: esquecer.php");
}

if(isset($_POST["enviar"])) {
    $login = mysqli_escape_string($connect,$_POST["login"]);
    $senha = mysqli_escape_string($connect,$_POST["senha"]);
    $erros = [];

    if(empty($login) or empty($senha)) {
        $erros[] = "<li> Preencha os campos corretamente</li>";
    } else {
        $sql = "SELECT Login From usuarios WHERE login = '$login'";
        $resultado = mysqli_query($connect,$sql);
        $senha = md5($senha);
            

        if(mysqli_num_rows($resultado) > 0 ) {
            $sql = "SELECT * From usuarios Where login = '$login' and senha = '$senha'";
            $resultado = mysqli_query($connect,$sql);

            if(mysqli_num_rows($resultado) == 1) {
                $dados = mysqli_fetch_array($resultado);
                $_SESSION["logado"] = true;
                $_SESSION["id"] = $dados["id"];
                $_SESSION["nome"] = $dados["Nome"];
                $_SESSION["login"] = $dados["Login"];
                $_SESSION["email"] = $dados["Email"];   
                header("location: home.php");

                

            } else {
                $erros[] = "<li>Senha incorreta</li>";
            }


        } else {
            $erros[] = "<li>Usuario inexistente</li>";
        }
    }
}




?>

<div class="formulario">
    <h1>Entre agora mesmo</h1> <br>
<form action="" method="post">

<div class="mb-3">
<label for="login" class="form-label" autocomplete="off">Login</label>
  <input type="text" class="form-control" id="login" name="login" autocomplete="off">
</div>

  <div class="mb-3">
    <label for="Senha" class="form-label" autocomplete="off">Digite sua Senha</label>
    <input type="password" class="form-control" id="Senha" name="senha" autocomplete="off">
  </div>
  <button type="submit" class="btn btn-success" name="enviar" autocomplete="off">Entrar</button> 
  <button type="submit" class="btn btn-secondary" name="esquecer" autocomplete="off" >Esqueci minha senha</button> 
  
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

<br><br> <br>
<div class="container dia">
    <div class="row">
        <div class="col">
           <a href="index.php"><img src="img/calc.png" alt="calculadora" width="200px" height="150px"></a>

        </div>
    </div>
</div>

<?php
include_once "html_css/footer.php";