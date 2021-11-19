<?php
session_start();
require_once '../db_connect.php';
include_once '../home/includes/header.php';

$erros = array();
function ValidaIndex() 
{
    $cpftest = str_split($_POST['cpf']);
    $countCpf = count($cpftest);

    $telefone = str_split($_POST['telefone']);
    $countTel = count($telefone);

    $senha = str_split($_POST['senha']);
    $countPasswd = count($senha);
    // Inicio do escopo de validação do form da index 
    if(preg_match('/[0-9]/', $_POST['nome']))
    {
        $erros[] = "<li style='color:red'> O nome não pode conter caracteres númericos</li>";
    } 
   if (preg_match('/[A-Za-z]/', $_POST['cpf']))
    {
        $erros[] = "<li style='color:red'> O CPF não pode conter caracteres alfabeticos</li>";
    } else {
    if ($countCpf != 11)
    {
     $erros[] = "<li style='color:red'> Digite um CPF válido</li>";
    }
    }
    if (!str_contains($_POST['email'],"@"))
    {
        $erros[] = "<li style='color:red'> Digite um e-mail válido</li>";  
    } 
    if (preg_match('/[A-Za-z]/', $_POST['telefone']) or $countTel != 11) 
    {
    // $erros[] = "<li style='color:red'>$countTel</li>"; 
        $erros[] = "<li style='color:red'> Digite um telefone válido</li>";  
    } 
    if ($countPasswd < 8) {
        $erros[] = "<li style='color:red'> Digite uma senha com no minimo 8 caracteres</li>";  
    }
    if ($countPasswd > 16)
    {
        $erros[] = "<li style='color:red'>A senha deve possuir no máximo 16 caracteres</li>";
    }
  // Final do escopo de validação do form da index
      $_SESSION['erro'] = $erros;
}

function Usuario($nome)
{
    $usuario = explode(" ", $nome);
    $count = count($usuario);
    $usuario1 = strtolower($usuario[0]) . '.' . strtolower($usuario[$count - 1]);
    return $usuario1;
}

if (isset($_POST['btn-submit']))
    {
    ValidaIndex();
    }

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
        header('Location: ../index.php');
    }
    include_once '../home/includes/footer.php';
}