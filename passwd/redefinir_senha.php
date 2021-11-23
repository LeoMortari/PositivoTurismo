<?php
//includes
include_once '../home/includes/header.php';
include_once '../db_connect.php';
session_start();

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PositivoTurismo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fruktur&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
    </script>
</head>

<body>
    <header>
        <?php
        include_once '../home/includes/header.php';

        ?>
        <div class="flex-container menu">
            <div>
                <h1>PositivoTurismo</h1>
            </div>
        </div>
    </header>
    <div>
        <?php
        if (isset($_SESSION['sucess-passwd'])) {
        ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var Modalelem = document.querySelector('#modal1');
                    var instance = M.Modal.init(Modalelem);
                    instance.open();
                });
            </script>
            <div id="modal1" class="modal bottom-sheet">
                <div class="modal-content">
                    <h4>Senha atualizada com sucesso!</h4>
                    <p>Não se esqueça de guarda-la em um local seguro.
                        <?php
                        session_unset();
                        ?>
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#form" class="modal-close waves-effect waves-green btn">Entendi</a>
                </div>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_SESSION['fail-passwd'])) {
        ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var Modalelem = document.querySelector('#modal1');
                    var instance = M.Modal.init(Modalelem);
                    instance.open();
                });
            </script>
            <div id="modal1" class="modal bottom-sheet">
                <div class="modal-content">
                    <h4 style="color:red">Erro:</h4>
                    <p> Não foi possível atualizar sua senha.
                        <?php
                        session_unset();
                        ?>
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#form" class="modal-close waves-effect waves-green btn">Entendi</a>
                </div>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_SESSION['repetido-passwd'])) {
        ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var Modalelem = document.querySelector('#modal1');
                    var instance = M.Modal.init(Modalelem);
                    instance.open();
                });
            </script>
            <div id="modal1" class="modal bottom-sheet">
                <div class="modal-content">
                    <h4 style="color:red">Erro:</h4>
                    <p>Esta já é sua senha.
                        <?php
                        session_unset();
                        ?>
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="#form" class="modal-close waves-effect waves-green btn">Entendi</a>
                </div>
            </div>
        <?php
        }
        ?>
        <section>
            <div class="container-principal">
                <div class="content-form">
                    <form action="upgradePasswd.php" method="POST" style="margin-top: 10rem;">
                        <h3 style="text-align:center;">Redefinir Senha</h3>
                        <p style="text-align:center;">Para redefinir sua senha, você deve informar os seguintes dados:</p><br>
                        <label>CPF:</label>
                        <input name="cpf" class="campo_cpf" type="text"><br>
                        <label>Nova senha:</label>
                        <input name="senha" id="senha" class="campo_senha" type="password"><br>
                        <input type="hidden" id="input" name="input">
                        <button name="btn-passwd" id="btn_submit" type="submit" class="btn blue darken-4">Cadastrar</button>
                        <a id="btn_submit" href="../login.php" class="btn blue darken-2">Login</a>
                        <p style="color:#D3D3D3; text-align:center;">Dica: é sempre bom anotar e guardar suas senhas em um local seguro.</p>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <div class="flex-container interna">
            <p>&copy; 2021 UNIVERSIDADE POSITIVO</p>
        </div>
    </footer>
    <?php include_once '../home/includes/footer.php'; ?>