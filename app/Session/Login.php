<?php

namespace App\Session;

class Login {

    /**
     * Método responsável por iniciar a sessão no BD
     */
    private static function init(){

        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

    }

    /**
     * Método respon´savel por retornar os dados do usuário logado
     * @return array
     */
    public static function getUsuarioLogado(){
        //INICIA A SESSÃO
        self::init();

        return self::isLogged() ? $_SESSION['usuario'] : null;
    }

    /**
     * Método repsonsável por logar o usuario
     * @param Usuario $obUsuario
     */
    public static function Login($obUsuario){
        //INICIA A SESSÃO
        self::init();

        $_SESSION['usuario'] = [
            'id'    => $obUsuario->id,
            'nome'  => $obUsuario->nome,
            'email' => $obUsuario->email
        ];

        //REDIRECIONA PARA O INDEX
        header('location: index.php');
        exit;
    }

    /**
     * Método responsável por deslogar
     */
    public static function logout(){
        //INICIA A SESSÃO
        self::init();

        unset($_SESSION['usuario']);

        //REDIRECIONA PARA O INDEX
        header('location: login.php');
        exit;


    }


    /**
     * Método responsável por verificar se esta logado
     * @return boolean
     */
    public static function isLogged () {
        //INICIA A SESSÃO
        self::init();

        return isset($_SESSION['usuario']['id']);
    }

    /**
     * Método responsável por obrigar o usuário estar logado
     */
    public static function requireLogin(){
        if (!self::isLogged()){
            header("location: login.php");
            exit;
        }

    }

    /**
     * Método responsável por obrigar o usuário estar deslogado
     */
    public static function requireLogout(){
        if (self::isLogged()){
            header("location: index.php");
            exit;
        }
    }

}

?>