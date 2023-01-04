<?php

namespace App\Db;

class Pagination {

    /**
     * NÚMERO MAXIMO DE REGISTROS POR PÁGINA
     * @var integer
     */
    private $limit;

    /**
     * QUANTIDADE TOTAL DE RESULTADOS DO BANCO
     * @var integer
     */
    private $results;

    /**
     * QUANTIDADE DE PÁGIANS
     * @var integer
     */
    private $pages;

    /**
     * PÁGINA ATUAL
     * @var integer
     */
    private $currentPages;


    /**
     * CONSTRUTOR DA PÁGINA
     * @param integer $results
     * @param integer $currentPages
     * @param integer $limit
     */
    public function __construct($results, $currentPages = 1, $limit = 10){
        $this->results = $results;
        $this->limit = $limit;
        $this->currentPages = (is_numeric($currentPages) and $currentPages > 0) ? $currentPages : 1;
        $this->calculate();
    }

      /**
       * MÉTODO RESPONSÁVEL POR CALCULAR A PAGINAÇÃO
       */
    private function calculate (){
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        $this->currentPages = $this->currentPages <= $this->pages ? $this->currentPages : $this->pages;
    }

    /**
     * Método responsável por retornar  a cláusula Limit da SQL
     * @return string
     */
    public function getLimit(){
        $offset = ($this->limit * ($this->currentPages - 1));
        return $offset.','.$this->limit;
    }

    /**
     * Método responsável por retornar as opções de páginas disponíveis
     * @return Array
     */
    public function getPages(){
        //Não retorna páginas
        if ($this->pages == 1) {
            return [];
        }
        
        //PÁGINAS 
        $paginas = [];
        for($i = 1; $i <= $this->pages; $i++){
            $paginas[] = [
                'pagina' => $i,
                'atual' => $i == $this->currentPages
            ];
        }

        return $paginas;
    }
}