<?php
session_start();
require_once '../../db_connect.php';
include_once '../../funcao.php';

if (isset($_POST['btn-cadastrar'])) {
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $usuario = Usuario($nome);
    $uf = strtoupper(mysqli_escape_string($connect, $_POST['uf']));
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $logradouro = mysqli_escape_string($connect, $_POST['logradouro']);
    $passaporte = mysqli_escape_string($connect, $_POST['passaporte']);
    $email = strtolower(mysqli_escape_string($connect, $_POST['email']));
    $idade = mysqli_escape_string($connect, $_POST['idade']);
    $senha = mysqli_escape_string($connect, md5($_POST['senha']));
    $sql = "INSERT INTO cliente (nome, cpf, email, uf, dataNascimento, logradouro, passaporte, usuario, senha) VALUES ('$nome', '$cpf', '$email', '$uf', '$idade', '$logradouro', '$passaporte','$usuario', '$senha')";
    echo $sql;
    if (mysqli_query($connect, $sql)) {
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('Location: ../index.php?sucesso');
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('Location: ../index.php?erro');
    }
}
