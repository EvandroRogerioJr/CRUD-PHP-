<?php

require __DIR__ . '/vendor/autoload.php';

define('TITLE', ' Cadastrar Cliente');

use \App\Entity\Cliente;
use \App\Entity\functions;
use \App\Session\Login;

//OBRIGA USUARIO A ESTAR LOGADO
Login::requireLogin();


$obCliente = new Cliente;


include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';


//Validação do POST
if(isset($_POST['nome'],$_POST['email'], $_POST['cpf'],$_POST['celular'])){

    if(!$_POST['nome'] || !$_POST['email'] || !$_POST['cpf'] || !$_POST['celular']){
        $mensagem = 'Favor preencher todos os campos';
        $css = "primary";
        $popup = functions::criaPopup($mensagem, $css);
        echo ($popup);
        exit;
    }

    $validacpf = functions::validaCPF($_POST['cpf']);
    if(!$validacpf){
        $mensagem = 'CPF Inválido';
        $css = "danger";
        $popup = functions::criaPopup($mensagem, $css);
        echo ($popup);
        exit;
    }

    $obCliente->nome = $_POST['nome'];
    $obCliente->email = $_POST['email'];
    $obCliente->cpf = $_POST['cpf'];
    $obCliente->celular = $_POST['celular'];
    $obCliente->cadastrar();

    header('location: index.php?status=success');
    exit;

}
