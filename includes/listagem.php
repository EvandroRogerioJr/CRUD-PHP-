<?php

use \App\Entity\functions;


    $mensagem = '';

    if(isset($_GET['status'])){
        switch($_GET['status']){
        case 'success':
            $mensagem = '<div class="alert mt-3 alert-success">Ação executada com sucesso!</div>';
            break;

        case 'error':
            $mensagem = '<div class="alert mt-3 alert-danger">Ação não executada!</div>';
            break;

        }
    }

    $resultados = '';
    foreach($clientes as $cliente){
    $cpfForm = $cliente->cpf;
    $cpfForm = functions::formatCnpjCpf($cpfForm);
    $celularForm = $cliente->celular;
    $celularForm = functions::formatPhone($celularForm);
        $resultados .= '<tr>
                            <td>'.$cliente->id.'</td>
                            <td>'.$cliente->nome.'</td>
                            <td>'.$cliente->email.'</td>
                            <td>'.$cpfForm.'</td>
                            <td>'.$celularForm.'</td>
                            <td>
                                <a href="editar.php?id='.$cliente->id.'">
                                    <button type"button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="excluir.php?id='.$cliente->id.'">
                                    <button type"button" class="btn btn-danger">Excluir</button>
                                </a>
                            </td>';
    }

$resultados = strlen($resultados) ? $resultados : '<tr>
                                                        <td colspan="6" class="text-center">
                                                            Nenhum Cliente encontrado
                                                        </td>
                                                       </tr>';

//GETS
unset($_GET['status']);
unset($_GET['pagina']);
$gets = http_build_query($_GET);

//PAGINAÇÃO
$paginacao = '';
$paginas = $obPagination->getPages();
foreach($paginas as $key=>$pagina){
    $class = $pagina['atual'] ? 'btn-primary' : 'btn-light';
    $paginacao .= '<a href="?pagina='.$pagina['pagina'].'&'.$gets.'">
                    <button type="button" class="btn '.$class.'">'.$pagina['pagina'].'</button>
                  </a>';
}
?>

<main>

    <?=$mensagem?>

    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success mt-4">Novo Clientes</button>
        </a>
    </section>

    <section>

        <form action="" method="get">

            <div class="row my-4">

                <div class="col">
                    <label for="">Buscar por:</label>
                    <select name="dados" class="form-control">
                        <option value="nome">Nome</option>
                        <option value="email" <?=$dadoBusca == 'email' ? 'selected': ''?> >E-mail</option>
                        <option value="cpf" <?=$dadoBusca == 'cpf' ? 'selected': ''?> >CPF</option>
                        <option value="celular" <?=$dadoBusca == 'celular' ? 'selected': ''?> >Celular</option>
                    </select>
                </div>

                <div class="col">
                    <label for="">Buscar por:</label>
                    <input type="text" name="busca" value="<?=$busca?>" class="form-control">
                </div>

                <div class="col d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>

            </div>

        </form>

    </section>

    <section>

        <table class="table bg-light mt-3">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>E-MAIL</th>
                    <th>CPF</th>
                    <th>CELULAR</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>

            <tbody>
                <?=$resultados?>
            </tbody>

        </table>

        <section>
            <?=$paginacao?>
        </section>

    </section>

</main>