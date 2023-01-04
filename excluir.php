<?php

require __DIR__ . '/vendor/autoload.php';


use \App\Entity\Cliente;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA CLINTE
$obCliente = Cliente::EdtCientes($_GET['id']);

//VALIDAÇÃO A VAGA
if(!$obCliente instanceof Cliente){
    header('location: index.php?status=error');
    exit;
}


//Validação do POST
if(isset($_POST['excluir'])){

    $obCliente->excluir();

    header('location: index.php?status=success');
    exit;

}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar-exclusao.php';
include __DIR__.'/includes/footer.php';
