<?php
session_start();
require_once '../db_connect.php';
include_once '../home/includes/header.php';
$telefone = str_split($_POST['telefone']);
$countTel = count($telefone);

$senha = str_split($_POST['senha']);
$countPasswd = count($senha);
if (isset($_POST['btn-submit'])){
    if (strpos($_POST['nome'],"teste") or empty($_POST['nome']) ) { 
      $erros[] = "<li style='color:red'> O nome não pode conter caracteres númericos</li>";
  } if (strpos($_POST['cpf'], "a") or empty($_POST['cpf'])) {
      $erros[] = "<li style='color:red'> O CPF não pode conter caracteres alfabeticos</li>";  
  } if (!strpos($_POST['email'],"@") or empty($_POST['email'])) {
      $erros[] = "<li style='color:red'> Digite um e-mail válido</li>";  
  } if (strpos($_POST['telefone'], "a") || $telefone != 11 || empty($_POST['telefone'])) {
    $erros[] = "<li style='color:red'> Digite um telefone válido</li>";  
  } if ($countPasswd < 8 or empty($_POST['senha'])) {
    $erros[] = "<li style='color:red'> Digite uma senha com no minimo 8 caracteres</li>";  
  }
      $_SESSION['erro'] = $erros;
  }

function Usuario($nome)
    {
        $usuario = explode(" ", $nome);
        $count = count($usuario);
        $usuario1 = strtolower($usuario[0]) . '.' . strtolower($usuario[$count - 1]);
        return $usuario1;
    }
    $erros = array();
    if (isset($_POST['btn-submit'])) {
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $usuario = Usuario($nome);
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $email = strtolower(mysqli_escape_string($connect, $_POST['email']));
    $idade = mysqli_escape_string($connect, $_POST['idade']);
    $senha = mysqli_escape_string($connect, md5($_POST['senha']));
    $sql = "INSERT INTO cliente (nome, cpf, email, dataNascimento, usuario, senha) VALUES ('$nome', '$cpf', '$email', '$idade', '$usuario', '$senha')";
    if (mysqli_query($connect, $sql)) {
        $_SESSION['modal-login'] = true;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['email'] = $email;
        header('Location: ../login.php');
    } else {
        // $_SESSION['modal-index-error'] = true;
        header('Location: ../index.php');
        // session_unset();
    }
    include_once '../home/includes/footer.php';
}


?>
        <!-- <form action="../login.php" method="post">
        <input type="hidden" name="usuario" value="<?php //$usuario ?>">
        <input type="hidden" name="email" value="<?php //$ab ?>">
        <input type="submit">
        </form> -->
        <?php