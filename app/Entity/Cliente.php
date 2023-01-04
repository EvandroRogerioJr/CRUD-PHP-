<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Cliente {

    /**
     * Indicador único
     * @var integer
     */
    public $id;

    /**
     * Nome do Cliente
     * @var string
     */
    public $nome;

    /**
     * Email do Cliente
     * @var mixed
     */
    public $email;

    /**
     * CPF do Cliente
     * @var mixed
     */
    public $cpf;
    
    /**
     * Celular do Cliente
     * @var mixed
     */
    public $celular;

    /**
     * Método responsável por cadastrar um cliente no banco
     * @return boolean
     */
    public function cadastrar(){

        //INSERIR O CLIENTE
        $obDatabase = new Database('usuarios');
        $this->id = $obDatabase->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'celular' => $this->celular
        ]);

        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método para atualizar o cliente
     * @return boolean
     */
    public function atualizar(){
        return (new Database('usuarios'))->update('id = '.$this->id,[
                                                                        'nome' => $this->nome,
                                                                        'email' => $this->email,
                                                                        'cpf' => $this->cpf,
                                                                        'celular' => $this->celular
                                                                    ]);
    }

    /**
     * Método respon´savel por excluir o cliente
     * @return boolean
     */
    public function excluir(){
        return (new Database('usuarios'))->delete('id= '.$this->id);
    }

    /**
     * Método responsável por obter os clientes do BD
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getCiente($where = null, $order = null, $limit= null){
        return (new Database('usuarios'))->select($where, $order, $limit)
                                         ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por obter a quantidade de cliente do BD
     * @param string $where
     * @return integer
     */
    public static function getQtdCiente($where = null){
        return (new Database('usuarios'))->select($where , null, null, 'COUNT(*) as qtd')
                                         ->fetchObject()
                                         ->qtd;
    }

    /**
     * Método repson´savel por buscar uma vaga com bsae no id
     * @param integer $id
     * @return Cliente
     */
    public static function EdtCientes($id){
        return (new Database('usuarios'))->select('id = '.$id)
                                         ->fetchObject(self::class);
    }
}