<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Usuario {

    /**
     * Id unico do Usuário
     * @var integer
     */
    public $id;

    /**
     * Nome do Usuario
     * @var string
     */
    public $nome;

    /**
     * Email do usuario
     * @var string
     */
    public $email;

    /**
     * Senha do usuario
     * @var string
     */
    public $senha;


    public function cadastrar()
    {
        $obDatabase = new Database('user');


        //INSERE NOVO USUARIO
        $this->id = $obDatabase->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);

        return true;
    }
    
    /**
     * Método respons´savel por pegar o usuario com base no seu email
     * @param string $email
     * @return Usuario
     */
    public static function getUsuarioPorEmail($email){
        return (new Database('user'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
}