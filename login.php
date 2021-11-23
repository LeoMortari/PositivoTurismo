<?php

include_once 'home/includes/header.php';
require_once 'db_connect.php';
require_once 'funcao.php';
session_start();

if (isset($_POST['btn-entrar'])) {
  $erros = array();
  $login = mysqli_escape_string($connect, $_POST['login']);
  $senha = mysqli_escape_string($connect, $_POST['senha']);
  if (empty($login) or empty($senha)) {
    $erros[] = "<li> O campo Login/Senha não pode estar vazio </li>";
  } else {
    if (strpos($login, '@')) {
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
        $erros[] = "<li>Email inexistente</li>";
      }
    } else {
      $sql = "SELECT usuario FROM cliente WHERE usuario = '$login'";
      if (strpos($sql, 'admin')) {
        $resultado = mysqli_query($connect, $sql);
        if (mysqli_num_rows($resultado) > 0) {
          $senha = md5($senha);
          $sql = "SELECT * FROM cliente WHERE usuario = '$login' AND senha = '$senha'";
          $resultado = mysqli_query($connect, $sql);
          if (mysqli_num_rows($resultado) == 1) {
            $dados = mysqli_fetch_array($resultado);
            mysqli_close($connect);
            $_SESSION['admin'] = true;
            $_SESSION['id_usuario'] = $dados['id'];
            header('Location: home/index.php');
          }
        }
      }
      $resultado = mysqli_query($connect, $sql);
      if (mysqli_num_rows($resultado) > 0) {
        $senha = md5($senha);
        $sql = "SELECT * FROM cliente WHERE usuario = '$login' AND senha = '$senha'";
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
        <li><a href="index.php" class="btn-small blue darken-3">Voltar</a></li>
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
        <label for="login">Usuario ou E-mail</label>
        <input type="text" name="login" value="">
        <label for="senha">Senha</label>
        <input type="password" name="senha">
        <div class="box-botao">
          <button name="btn-entrar" class="btn-small blue darken-4" type="submit">
            <span>Entrar</span>
          </button>
        </div>
        <?php
        if (!empty($erros)) {
        ?>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              var Modalelem = document.querySelector('#modal1');
              var instance = M.Modal.init(Modalelem);
              instance.open();
            });
          </script>
          <div id="modal1" class="modal">
            <div class="modal-content">
              <h4>ATENÇÃO!</h4>
              <p><?php
                  foreach ($erros as $erro) {
                    echo $erro;
                  }
                  ?></p>
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-close waves-effect waves-green btn">Entendi</a>
            </div>
          </div>
        <?php } ?>
      </form>
    </div>
  </section>
  <?php
  if (isset($_SESSION['modal-login'])) {
  ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var Modalelem = document.querySelector('#modal1');
        var instance = M.Modal.init(Modalelem);
        instance.open();
      });
    </script>
    <div id="modal1" class="modal">
      <div class="modal-content">
        <h4>Cadastro Concluido!</h4>
        <p>Seu usuário é: <b><?php echo $_SESSION['usuario'] ?></b><br>
          Você pode utilizar seu email "<b><?php echo $_SESSION['email'] ?></b>" ou seu usuário para realizar login na plataforma.
        </p>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn">Entendi</a>
      </div>
    </div>
  <?php
  }
  ?>
  <footer>
    <div class="flex-container interna">
      <p>&copy; 2021 UNIVERSIDADE POSITIVO</p>
    </div>
    <?php
    //Footer
    include_once 'home/includes/footer.php';
    ?>
  </footer>
</body>

</html>