  <?php
  include_once 'home/includes/header.php';
  session_start();
  $erros = array();
  ?>
<!DOCTYPE html>
<html lang="pt-br">
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
    <div class="flex-container menu">
      <div>
        <h1>PositivoTurismo</h1>
      </div>
      <ul class="list-items col s12">
        <li><a href="#quem-somos">Quem Somos</a></li>
        <li><a href="#servicos">Serviços</a></li>
        <li><a href="#planos">Planos</a></li>
        <!-- Irei refazer o style do login depois: Leo -->
        <li><a href="./login.php" class="login">Login</a></li>
      </ul>
    </div>
  </header>
  <div class="flex-container apresentacao">
    <div>
      <div class="texto-apresentacao">
        <h1>Positivo<br>Turismo</h1>
        <p>O melhor serviço para você!</p>
        <a href="#planos" class="btn blue darken-4">Saiba Mais!</a>
      </div>
    </div>
    <div>
      <div><img src="./images/0-main.png" alt="banner de apresentação"></div>
    </div>
  </div>
  <div class="flex-container" id="quem-somos">
    <div>
      <img src="./images/1-quem-somos.png" alt="balcão de atendimento">
    </div>
    <div class="responsivo">
      <h2>Quem somos</h2>
      <p>Website de uma agência de viagem que intermedia serviços entre seus clientes e determinados destinos
        turísticos.
        O principal intuito é facilitar, por meio de uma interface de fácil acesso, o agendamento para a locomoção. </p>
    </div>
  </div>
  <div class="container-externo">
    <div class="flex-container" id="servicos">
      <div class="list-servicos">
        <div class="item-servico">
          <div><img class="svg" src="./images/icon-2.png" alt="hospedagens"></div>
          <p>Hospedagens</p>
          <a href="login.php" class="btn">Comprar Agora</a>
        </div>
        <div class="item-servico">
          <div><img class="svg" src="./images/icon-1.png" alt="pacote de viagens"></div>
          <p>Pacotes de viagens</p>
          <a href="login.php" class="btn">Comprar Agora</a>
        </div>
        <div class="item-servico">
          <div><img class="svg" src="./images/icon-3.png" alt="roteiros personalizados"></div>
          <p>Roteiros personalizados</p>
          <a href="login.php" class="btn">Comprar Agora</a>
        </div>
      </div>
    </div>
  </div>
  <div class="flex-container" id="planos">
    <div class="list-planos">
      <div class="item-plano">
        <h3>Plano 1</h3>
        <ul>
          <li>Suporte 24h</li>
          <li>Serviços de quarto</li>
          <li>Guia turístico</li>
        </ul>
        <a href="#form" class="btn">Selecionar</a>
      </div>
      <div class="item-plano">
        <h3>Plano 2</h3>
        <ul>
          <li>Suporte 24h</li>
          <li>Serviços de quarto</li>
          <li>Guia turístico</li>
          <li>Roteiro de trilhas</li>
          <li>Serviço personalizado</li>
        </ul>
        <a href="#form" class="btn">Selecionar</a>
      </div>
      <div class="item-plano">
        <h3>Plano 3</h3>
        <ul>
          <li>Suporte 24h</li>
          <li>Serviços de quarto</li>
          <li>Guia turístico</li>
          <li>Roteiro de trilhas</li>
          <li>Serviço personalizado</li>
          <li>Área Vip</li>
        </ul>
        <a href="#form" class="btn">Selecionar</a>
      </div>
    </div>
  </div>
    <?php
    if (isset($_SESSION['erro'])) {
    ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var Modalelem = document.querySelector('#modal1');
    var instance = M.Modal.init(Modalelem);
    instance.open();
    });
</script>
<div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Atenção!</h4>
      <p>
      <?php
      foreach ($_SESSION['erro'] as $erro){
      echo $erro;
      };
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
  <section id="form">
    <div class="bg-form">
      <div class="container-principal">
        <div class="content-form">
          <form action="php_form/insert.php" method="POST">
            <fieldset>
              <h3>Complete com seus dados</h3>
              <label>Nome:</label>
              <input name="nome" class="campo_nome" type="text" required><br>
              <label>CPF:</label>
              <input name="cpf" class="campo_cpf" type="text"><br>
              <label>Email:</label>
              <input name="email" class="campo_email" type="text"><br>
              <label>Telefone:</label>
              <input name="telefone" class="campo_telefone" type="text"><br>
              <label>Senha:</label>
              <input id="senha" name="senha" class="campo_senha" type="password"><br>
              <label>Data de nascimento:</label>
              <input name="idade" class="campo_nasc" type="date"><br>
              <button name="btn-submit" id="btn_submit" type="submit" class="btn blue darken-4">Cadastrar</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="flex-container interna">
      <p>&copy; 2021 UNIVERSIDADE POSITIVO</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
  </script>
</body>
</html>