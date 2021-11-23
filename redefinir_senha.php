<?php
include_once './home/includes/header.php';

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PositivoTurismo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fruktur&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
    </script>
</head>

<body>
    <header>
        <?php
        include_once './home/includes/header.php';

        ?>
        <div class="flex-container menu">
            <div>
                <h1>PositivoTurismo</h1>
            </div>
        </div>
    </header>
    <div>
        <section>
            <div class="container-principal">
                <div class="content-form">
                    <form action="" method="POST" style="margin-top: 10rem;">
                        <h3>Redefinir Senha</h3>
                        <p>Para redefinir sua senha, você deve informar os seguintes dados:</p><br>
                        <label>CPF:</label>
                        <input name="cpf" class="campo_cpf" type="text"><br>
                        <label>Nova senha:</label>
                        <input name="senha" id="senha" class="campo_senha" type="password"><br>
                        <input type="hidden" id="input" name="input">
                        <button name="btn-submit" id="btn_submit" type="submit" class="btn blue darken-4">Cadastrar</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <?php include_once './home/includes/footer.php'; ?>
    </footer>
</body>

</html>