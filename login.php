<?php
// Conexão banco de dados
require_once 'db_connect.php';

// Sessão
session_start();

// Botão enviar
if (isset($_POST['btn-entrar'])) {
  $erros = array();
  $login = mysqli_escape_string($connect, $_POST['login']);
  $senha = mysqli_escape_string($connect, $_POST['senha']);

  if (empty($login) or empty($senha)) {
    $erros[] = "<li> O campo Login/Senha não pode estar vazio </li>";
  } else {
    $sql = "SELECT usuario FROM cliente WHERE email = '$login'";
    $resultado = mysqli_query($connect, $sql);

    if (mysqli_num_rows($resultado) > 0) {
      $senha = md5($senha);
      $sql = "SELECT * FROM cliente WHERE email = '$login' AND senha = '$senha'";
      $resultado = mysqli_query($connect, $sql);
      if (mysqli_num_rows($resultado) == 1) {
        $dados = mysqli_fetch_array($resultado);
        mysqli_close($connect);
        $_SESSION['logado'] = true;
        $_SESSION['id_usuario'] = $dados['id'];
        header('Location: home.php');
      } else {
        $erros[] = "<li>Usuário e Senha não conferem</li>";
      }
    } else {
      $erros[] = "<li>Usuário inexistente</li>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <link rel="stylesheet" href="./style.css">
  <title>Login</title>
</head>

<body>

  <header>
    <div class="flex-container menu">
      <div>
        <a href="./index.php" style="text-decoration:none; color:white">
          <h1>PositivoTurismo</h1>
        </a>
      </div>
      <ul class="list-items">
        <li><a href="#quem-somos">Quem Somos</a></li>
        <li><a href="#servicos">Serviços</a></li>
        <li><a href="#planos">Planos</a></li>
      </ul>
    </div>
  </header>

  <section id="box-form">
    <div class="container-principal">
      <form class="form-edit" method="POST" action="#">
        <div class=topo-form>
          <h1>Entrar</h1>
          <img src="images/bagagem-de-viagem.svg">
        </div>
        <label for="email">Usuario</label>
        <input type="text" name="login" value="">
        <label for="senha">Senha</label>
        <input type="password" name="senha">
        <div class="box-botao">
          <button name="btn-entrar" type="submit" value="Entrar">
            <span>Entrar</span>
          </button>
          <?php
          if (!empty($erros)) {
            foreach ($erros as $erro) {
              echo $erro;
            }
          }
          ?>
        </div>
      </form>
    </div>
  </section>

  <footer>
    <div class="flex-container interna">
      <p>&copy; 2021 UNIVERSIDADE POSITIVO</p>
    </div>
  </footer>
</body>

</html>