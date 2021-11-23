<?php
require_once 'C:/xampp/htdocs/PositivoTurismo/db_connect.php';

function ValidaIdade ($aniversario) {
    $anoAtual = intval(date("Y"));
    $dataBD = explode('-', $aniversario);
    $ano = intval($dataBD[0]);
    $idade = $anoAtual - $ano;
    echo $idade;
    return $idade;
}
$erros = array();
function ValidaIndex() 
{
    $cpftest = str_split($_POST['cpf']);
    $countCpf = count($cpftest);

    $telefone = str_split($_POST['telefone']);
    $countTel = count($telefone);

    $senha = str_split($_POST['senha']);
    $countPasswd = count($senha);


    $aniversario = strval($_POST['idade']);
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
    if (!strpos($_POST['email'],"@" or !strpos($_POST['email'], ".com")))
    {
        $erros[] = "<li style='color:red'> Digite um e-mail válido</li>";  
    } 

    if (preg_match('/[A-Za-z]/', $_POST['telefone']) or $countTel != 11)
    { 
        $erros[] = "<li style='color:red'> Digite um telefone válido</li>";  
    }
    if (isset($_POST['input'])) {
        $senha = $_POST['input'];
        if ($senha == 0)
        {
            $erros[] = "<li style='color:red'>Você deve digitar uma senha que contenha pelo menos: 1 Maiusculo, 1 minusculo e 1 número</li>";
        }
    }
        // Senha menor que 8
        if($countPasswd < 8)
        {
            $erros[] = "<li style='color:red'> Digite uma senha com no minimo 8 caracteres</li>"; 
        }

        //Senha menor que 16
        if ($countPasswd > 16)
        {
        $erros[] = "<li style='color:red'>A senha deve possuir no máximo 16 caracteres</li>";
        }
    }
      $_SESSION['erro'] = $erros;

      if (count($_SESSION['erro']) == 0){
          return 0;
      } else {
          return 1;
      }

function Usuario($nome)
{
    $usuario = explode(" ", $nome);
    $count = count($usuario);
    $usuario1 = strtolower($usuario[0]) . '.' . strtolower($usuario[$count - 1]);
    return $usuario1;
}

function ValidaCpf ($cpf) {
    $sql = "SELECT * FROM cliente WHERE cpf = '$cpf'";
    $query = mysqli_query($connect, $sql);
    if (mysqli_num_rows($query) > 0) {
        echo '1';
        return 1;
    } else {
        echo '0';
        return 0;
    }
}
