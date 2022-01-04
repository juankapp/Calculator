<?php session_start(); 
if(!isset($_SESSION["logado"])) {
    header("location: index.php");
   }



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="html_css/css.css" />
</head>

<body>

    <div class="container-fluid titulo">
        <div class="row">
            <div class="col-12">
                <h1>Seja bem Vindo  <?php echo $_SESSION["nome"]; ?> </h1>
            </div>
        </div>
    </div>

    <div class="container-fluid menu ">
        <div class="row">
            <div class="col">
            
            <a href="sair.php"><button type="button" class="btn btn-danger">Sair</button></a>
            </div>
        </div>

    </div>
<div class="container index">
    <div class="row">
        <div class="col">

            
<?php

if (isset($_POST["calcular"])) {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $operador = $_POST["operador"];
    $erros = [];



    if (empty($num1) or empty($num2) or empty($operador)) {
        $erros[] = "<li>preencha os campos corretamente ";
    } else {
        switch ($operador) {
            case "+":
                $resultado =  $num1 + $num2;
                break;
            case "-":
                $resultado =  $num1 - $num2;
                break;
            case "/":
                $resultado =  $num1 / $num2;
                break;
            case "*":
                $resultado =  $num1 * $num2;
                break;
        }
    }
}

?>



<div class="formulario">
<form action="#" method="POST">

<h3 class="text"><label for="inputPassword5" class="form-label"> Primeiro Numero</label></h3>
<input type="number" name="num1" class="form-control" aria-describedby="passwordHelpBlock">

<h3 class="text"><label for="inputPassword5" class="form-label">Segundo Numero</label></h3>
<input type="number" name="num2" class="form-control" aria-describedby="passwordHelpBlock">




<h3 class="text"><label for="inputPassword5" class="form-label">Qual Operacao</label></h3>
<select class="form-select" aria-label="Default select example" name="operador">

    <option value="+">adição</option>
    <option value="-">subtracao</option>
    <option value="/">divisao</option>
    <option value="*">multiplicacao</option>
</select> <br>

<button name="calcular" class="btn btn-primary">Calcular</button> <br><br><br>

<?php
if (!empty($erros)) {
    foreach ($erros as $erro) {
?>
        <div class="alert alert-danger" role="alert">
            <?php echo $erro;
            ?>
        </div>

</div>
<?php
    }
}

?>

<?php if (isset($resultado)) {
?> <div class="alert alert-success" role="alert">
        <p class="text-result">
            <?php echo " O resultado de $num1 $operador $num2 é igual a $resultado";   ?>
        </p>
    </div>
<?php
} ?>



</form>
</div>




    <?php
    include_once "html_css/footer.php";
    ?>

