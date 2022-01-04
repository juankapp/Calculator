<link rel="stylesheet" type="text/css" href="html_css/css.css" />

<?php

session_start();
  if(isset($_SESSION["logado"])) {
    header("location: home.php");
  }

include_once "html_css/header.php";

?>


<div class="container apresentacao">
    <div class="row">
        <h1 class="tit">Porque a Calculator é a melhor do mercado?</h1> <br> <br><br>
        <div class="col-5">
            <div class="card" style="width: 18rem;">
                <div class="img">
                    <img src="img/calculadora.png" class="card-img-top" alt="...">
                    <div class="card-body">

                        <p class="card-text">Calculos extremamente eficientes, disputando entre as maiores calculadoras do mercado.</p>

                    </div>
                </div>

            </div>


        </div>
        <div class="col-6">
            <H2 class="doutrina" >Venha fazer parte da familia Calculator</H2>
            <div class="botao"><a href="adicionar.php" ><button class="btn btn-success botao">Cadastre-se ja</button> </a> </div>
        </div>
    </div>
<div>






    <?php
    include_once "html_css/footer.php";
    ?>