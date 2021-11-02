<?php
//Header
include_once 'includes/header.php';
?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h3 class="light">Novo Cliente</h3>
        <form action="php_action/create.php" method="POST">
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome">
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="cpf" id="cpf">
                <label for="cpf">CPF</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="email" id="email">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="uf" id="uf">
                <label for="uf">UF</label>
            </div>
            <div class="input-field col s12">
                <input type="date" name="idade" id="idade">
                <label for="idade">Data de Nascimento</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="logradouro" id="logradouro">
                <label for="logradouro">Logradouro</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="passaporte" id="passaporte">
                <label for="passaporte">Passaporte</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="senha" id="senha">
                <label for="senha">Senha</label>
            </div>
            <a href="index.php" class="btn orange">Voltar</a>
            <button type="submit" name="btn-cadastrar" class="btn green">Cadastrar</button>
        </form>
    </div>
</div>
<?php
//Footer
include_once 'includes/footer.php';
?>