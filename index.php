<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Cliente;
use \App\Db\Pagination;
use \App\Session\Login;

//OBRIGA USUARIO A ESTAR LOGADO
Login::requireLogin();


//Busca
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

//DADOS A SER BUSCADO
$dadoBusca = filter_input(INPUT_GET, 'dados', FILTER_SANITIZE_STRING);

//CONDIÇÕES SQL
$condicoes = [
    strlen($busca) ? ''.$dadoBusca.' LIKE "%'.str_replace(' ', '%', $busca).'%"' : null
];

//CLAUSULA WHERE
$where = implode(' AND ', $condicoes);


//QUANTIDADE TOTAL DE VAGAS
$quantidadeCliente = Cliente::getQtdCiente($where);

//PAGINAÇÃO
$obPagination = new Pagination($quantidadeCliente, $_GET['pagina'] ?? 1, 5);

$clientes = Cliente::getCiente($where, null, $obPagination->getLimit()); 


include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem.php';
include __DIR__.'/includes/footer.php';
