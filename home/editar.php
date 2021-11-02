<?php
include_once '../db_connect.php';
//Header
include_once 'includes/header.php';

if (isset($_GET['id'])) {
    $id = mysqli_escape_string($connect, $_GET['id']);
    $sql = "SELECT * FROM cliente WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
}
?>


<div class="row">
    <div class="col s12 m6 push-m3">
        <h3 class="light">Editar Cliente</h3>
        <form action="php_action/update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome" value="<?php echo $dados['nome']; ?>">
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="cpf" id="cpf" value="<?php echo $dados['cpf']; ?>">
                <label for="cpf">CPF</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="email" id="email" value="<?php echo $dados['email']; ?>">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="uf" id="uf" value="<?php echo $dados['uf']; ?>">
                <label for="uf">UF</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="idade" id="idade" value="<?php echo $dados['dataNascimento']; ?>">
                <label for="idade">Data de Nascimento</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="logradouro" id="logradouro" value="<?php echo $dados['logradouro']; ?>">
                <label for="logradouro">Logradouro</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="passaporte" id="passaporte" value="<?php echo $dados['passaporte']; ?>">
                <label for="passaporte">Passaporte</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="senha" id="senha" value="<?php echo $dados['senha']; ?>">
                <label for="senha">Senha</label>
            </div>
            <a href="index.php" class="btn orange">Voltar</a>
            <button type="submit" name="btn-editar" class="btn green">Atualizar</button>
        </form>
    </div>
</div>

<?php
//Footer
include_once 'includes/footer.php';
?>