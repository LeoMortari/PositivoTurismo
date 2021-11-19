<?php
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