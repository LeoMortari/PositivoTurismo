<?php
session_start();
require_once '../../db_connect.php';

if (isset($_POST['btn-editar'])) {
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $email = mysqli_escape_string($connect, $_POST['email']);
    $uf = mysqli_escape_string($connect, $_POST['uf']);
    $idade = mysqli_escape_string($connect, $_POST['idade']);
    function InverteData($idade)
    {
        $dataNormal = explode("/", $idade);
        $dataBanco = $dataNormal[2] . "-" . $dataNormal[1] . "-" . $dataNormal[0];
        echo $dataBanco;
        return $dataBanco;
    }
    $idade = InverteData($idade);
    $logradouro = mysqli_escape_string($connect, $_POST['logradouro']);
    $passaporte = mysqli_escape_string($connect, $_POST['passaporte']);
    if ($passaporte == "") {
        global $passaporte;
        $passaporte = 'Null';
    }
    $senha = mysqli_escape_string($connect, md5($_POST['senha']));
    $id = mysqli_escape_string($connect, $_POST['id']);
    $sql = "UPDATE cliente SET nome = '$nome', cpf = '$cpf', email = '$email', uf = '$uf', dataNascimento = '$idade', logradouro = '$logradouro', passaporte = '$passaporte', senha = '$senha' WHERE id = '$id'";

    if (mysqli_query($connect, $sql)) {
        $_SESSION['mensagem'] = "Atualizado com sucesso!";
        header('Location: ../index.php?sucesso');
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar!";
        header('Location: ../index.php?erro');
    }
}
