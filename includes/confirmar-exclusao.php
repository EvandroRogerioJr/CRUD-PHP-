<main>

    <h2 class="mt-4">Excluir Cliente</h2>
    
    <form method="post">

        <div class="form-group mt-2">
            <p>Você deseja realmente excluir o Cliente <strong><?=$obCliente->nome?></strong> ?</p>
        </div>

        <div class="form-group">
            <a href="index.php">
                <button type="button" class="btn btn-success mt-4">Cancelar</button>
            </a>

            <button type="submit" name="excluir" class="btn btn-danger mt-4">Excluir</button>
        </div>

    </form>
    
</main>