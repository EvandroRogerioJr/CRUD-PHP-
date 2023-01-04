<?php

$mensagem = '';

?>

<main>


    <section>
        <a href="index.php">
            <button class="btn btn-success mt-4">Voltar</button>
        </a>
    </section>

    <h2 class="mt-4"><?=TITLE?></h2>

    <?=$mensagem?>

    
    <form method="post">

        <div class="form-group mt-2">
            <label>Nome:</label>
            <input type="text" class="form-control mt-2" name="nome" value="<?=$obCliente->nome?>">
        </div>

        <div class="form-group mt-2">
            <label>E-mail:</label>
            <input type="text" class="form-control mt-2" name="email" value="<?=$obCliente->email?>">
        </div>

        <div class="form-group mt-2">
            <label>CPF:</label>
            <input type="text" maxlength="11" class="form-control mt-2" name="cpf" value="<?=$obCliente->cpf?>">
        </div>

        <div class="form-group mt-2">
            <label>Celular:</label>
            <input type="text" class="form-control mt-2" name="celular" value="<?=$obCliente->celular?>">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success mt-4">Enviar</button>
        </div>

    </form>
    
</main>