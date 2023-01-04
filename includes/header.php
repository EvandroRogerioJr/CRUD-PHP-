<?php

use \App\Session\Login;

$usuarioLogado = Login::getUsuarioLogado();

$usuario = $usuarioLogado ? $usuarioLogado['nome'] . ' <a href="logout.php" class="text-light font-weight-bold ms-2">Sair</a>'
                          : 'Visitante <a href="login.php" class="text-light font-weight-bold ms-2">Entrar</a>';

?>

<!doctype html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes Jr</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>

  <body class="bg-dark text-light">

  <div class="container">

    <div class="jumbotron p-5 rounded bg-primary">
        <h1>Clientes Jr</h1>

        <hr class="border-light">

        <div class="d-flex justify-content-start">
          <?=$usuario?>
        </div>

    </div>