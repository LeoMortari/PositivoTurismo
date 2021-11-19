<?php
session_start();
require_once '../db_connect.php';
include_once '../home/includes/header.php';
require_once '../validacao.php';

$erros = array();

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