<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Usuario;
use \App\Session\Login;

//OBRIGA USUARIO A ESTAR DESLOGADO
Login::requireLogout();

//MENSAGEM DE ALERTA
$alertaLogin = '';
$alertaCadastro = '';


if(isset($_POST['acao'])){
    switch($_POST['acao']){


        case 'logar':

            //BUSCA USUARIO ATRAVÉS DO EMAIL
            $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);

            //VALIDA A INSTANCIA E A SENHA
            if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'], $obUsuario->senha)){
                $alertaLogin = 'Email ou senhas inválidos';
                break;
            }

            Login::Login($obUsuario);

            break;


        case 'cadastrar':

            if(isset($_POST['nome'], $_POST['email'], $_POST['senha'])){
                
                //BUSCA USUARIO ATRAVÉS DO EMAIL
                $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
                if($obUsuario instanceof Usuario){
                    $alertaCadastro = 'O Email já esta em uso';
                    break;
                }


                //NOVO USUARIO
                $obUsuario = new Usuario;
                $obUsuario->nome = $_POST['nome'];
                $obUsuario->email = $_POST['email'];
                $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $obUsuario->cadastrar();

                Login::Login($obUsuario);

            }
            break;
    }
}


include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario-login.php';
include __DIR__.'/includes/footer.php';
