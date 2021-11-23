<?php
session_start();
require_once 'C:/xampp/htdocs/PositivoTurismo/db_connect.php';
include_once 'C:/xampp/htdocs/PositivoTurismo/funcao.php';

if (isset($_POST['btn-cadastrar'])) {
    ValidaIndex();
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $usuario = Usuario($nome);
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $email = strtolower(mysqli_escape_string($connect, $_POST['email']));
    $uf = strtoupper(mysqli_escape_string($connect, $_POST['uf']));
    $idade = mysqli_escape_string($connect, $_POST['idade']);
    $logradouro = mysqli_escape_string($connect, $_POST['logradouro']);
    $passaporte = mysqli_escape_string($connect, $_POST['passaporte']);
    if ($passaporte == "") {
        global $passaporte;
        $passaporte = 'Não possui';
    }
    $senha = mysqli_escape_string($connect, md5($_POST['senha']));

    $sql = "INSERT INTO cliente (nome, cpf, email, uf, dataNascimento, logradouro, passaporte, usuario, senha) VALUES ('$nome', '$cpf', '$email', '$uf', '$idade', '$logradouro', '$passaporte','$usuario', '$senha')";

    if (mysqli_query($connect, $sql)) {
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('Location: ../index.php?sucesso');
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('Location: ../index.php?erro');
    }
}
