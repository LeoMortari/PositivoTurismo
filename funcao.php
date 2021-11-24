<?php
require_once 'C:/xampp/htdocs/PositivoTurismo/db_connect.php';

function ValidaIdade($aniversario)
{
    $anoAtual = intval(date("Y"));
    $dataBD = explode('-', $aniversario);
    $ano = intval($dataBD[0]);
    $idade = $anoAtual - $ano;
    return $idade;
}

function ValidaIndex()
{
    $cpf = $_POST['cpf'];
    $cpftest = str_split($cpf);
    $countCpf = count($cpftest);

    $telefone = str_split($_POST['telefone']);
    $countTel = count($telefone);

    $senha = str_split($_POST['senha']);
    $countPasswd = count($senha);

    $aniversario = strval($_POST['idade']);
    // Inicio do escopo de validação do form da index 
    if (filter_var($_POST['nome'], FILTER_SANITIZE_NUMBER_INT) or filter_var($_POST['nome'], FILTER_SANITIZE_NUMBER_FLOAT)) {
        $erros[] = "<li style='color:red'> O nome não pode conter caracteres númericos</li>";
    }
    $cpfInt = intval($_POST['cpf']);
    if (is_null($cpfInt)) {
        $erros[] = "<li style='color:red'> O CPF não pode conter caracteres alfabeticos</li>";
    } else {
        $cepef = ValidaCpf($cpf);
        if ($cepef == 0) {
            if ($countCpf != 11) {
                if ($countCpf == 14) {
                    $erros[] = "<li style='color:red'>Não se deve usar um CPNJ para cadastrar</li>";
                } else {
                    $erros[] = "<li style='color:red'> Digite um CPF válido</li>";
                }
            }
        } else if ($cepef == 1) {
            $erros[] = "<li style='color:red'>Essa pessoa já possui uma conta</li>";
        }

        if (!strpos($_POST['email'], "@") or !strpos($_POST['email'], ".com")) {
            $erros[] = "<li style='color:red'> Digite um e-mail válido</li>";
        }

        if (isset($_POST['idade'])) {
            $aniversario = $_POST['idade'];
            $valida = ValidaIdade($aniversario);
            if ($valida < 18) {
                $erros[] = "<li style='color:red'>Você precisa ter mais de 18 anos para se cadastrar</li>";
            }
        }

        if (preg_match('/[A-Za-z]/', $_POST['telefone']) or $countTel != 11 && $countTel != 10) {
            $erros[] = "<li style='color:red'> Digite um telefone válido</li>";
        }
        if (isset($_POST['input'])) {
            $senha = intval($_POST['input']);
            if (ValidaSenha($_POST['senha'], $_POST['nome']) == 0) {
                $erros[] = "<li style='color:red'>Sua senha não pode conter partes do seu nome</li>";
            } else {
                if ($senha == 0) {
                    if ($countPasswd < 8) {
                        $erros[] = "<li style='color:red'>Você deve digitar uma senha que contenha pelo menos: 1 Maiusculo, 1 minusculo e 1 número com no minimo 8 caracteres</li>";
                    } else if ($countPasswd > 16) {
                        $erros[] = "<li style='color:red'>Você deve digitar uma senha que contenha pelo menos: 1 Maiusculo, 1 minusculo e 1 número com no máximo 16 caracteres</li>";
                    } else {
                        $erros[] = "<li style='color:red'>Você deve digitar uma senha que contenha pelo menos: 1 Maiusculo, 1 minusculo e 1 número</li>";
                    }
                }
            }
        }
        $_SESSION['erro'] = $erros;

        if (is_null($_SESSION['erro'])) {
            return 0;
        } else {
            return 1;
        }
    }
}
function Usuario($nome)
{
    $usuario = explode(" ", $nome);
    $count = count($usuario);
    $usuario1 = strtolower($usuario[0]) . '.' . strtolower($usuario[$count - 1]);
    return $usuario1;
}

function ValidaCpf($cpf)
{
    $servername = "localhost";
    $username = "root";
    $senha = "";
    $dbname = "projeto";
    $connect = mysqli_connect($servername, $username, $senha, $dbname);

    $sql = "SELECT nome FROM cliente WHERE cpf = '$cpf'";
    $query = mysqli_query($connect, $sql);
    if (mysqli_num_rows($query) > 0) {
        return 1;
    } else {
        return 0;
    }
}

function GravaSenha($connect, $senhaAtual, $cpf)
{
    $senha = mysqli_query($connect, "SELECT senha FROM cliente WHERE cpf = '$cpf'");
    while ($dados = mysqli_fetch_assoc($senha)) {
        foreach ($dados as $field => $value) {
            $field . ' => ' . $value;
        }
        $passwd = $value;
    }
    $senha1 = mysqli_query($connect, "SELECT senha1 FROM cliente WHERE cpf = '$cpf'");
    while ($dados = mysqli_fetch_assoc($senha1)) {
        foreach ($dados as $field => $value) {
            $field . ' => ' . $value;
        }
        $passwd1 = $value;
    }

    $senha2 = mysqli_query($connect, "SELECT senha2 FROM cliente WHERE cpf = '$cpf'");
    while ($dados = mysqli_fetch_assoc($senha2)) {
        foreach ($dados as $field => $value) {
            $field . ' => ' . $value;
        }
        $passwd2 = $value;
    }

    $senha3 = mysqli_query($connect, "SELECT senha2 FROM cliente WHERE cpf = '$cpf'");
    while ($dados = mysqli_fetch_assoc($senha3)) {
        foreach ($dados as $field => $value) {
            $field . ' => ' . $value;
        }
        $passwd2 = $value;
    }
    if ($senhaAtual == $passwd or $senhaAtual == $passwd1 or $senhaAtual == $passwd2) {
        return 0;
    } else {
        mysqli_query($connect, "UPDATE cliente SET senha = '$senhaAtual' WHERE cpf = '$cpf'");
        mysqli_query($connect, "UPDATE cliente SET senha1 = '$passwd' WHERE cpf = '$cpf'");
        mysqli_query($connect, "UPDATE cliente SET senha2 = '$passwd1' WHERE cpf = '$cpf'");
        mysqli_query($connect, "UPDATE cliente SET senha3 = '$passwd2' WHERE cpf = '$cpf'");
        return 1;
    }
}

function ValidaSenha($senha, $nome)
{
    $passwd = str_split($senha);
    $array = count($passwd) - 1;
    $name = str_split($nome);
    $error = array();
    $i = 0;
    while ($i <= $array) {
        if ($passwd[$i] == $name[$i]) {
            array_push($error, "erro");
        }
        $i++;
    }
    if (count($error) >= 3) {
        return 0;
    } else {
        return 1;
    }
}
