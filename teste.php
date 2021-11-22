<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>
<body>

<script>
    const MAIUSCULA = new Set('ABCDEFGHIJKLMNOPQRSTUVWXYZ')
    const MINUSCULA = new Set('abcdefghijklmnopqrstuvwxyz')
    function isNumber(c) { return c === '' + Number(c) }
    
    function validaSenha(s) {
      let encontreMaiuscula = 0
      let encontreMinuscula = 0
      let encontreNumero = 0
    
      for (let c of s) {
        encontreMaiuscula = encontreMaiuscula || MAIUSCULA.has(c)
        encontreMinuscula = encontreMinuscula || MINUSCULA.has(c)
        encontreNumero = encontreNumero || isNumber(c)
        if (encontreMaiuscula && encontreMinuscula && encontreNumero) return 1
      }
    
      return 0
    }
    var validasenha = validaSenha("<?php echo "Leonardo"; ?>");
    // console.log(validaSenha("<?php echo "Leonardo"; ?>"))
    </script>
    <?php
    // echo "<script>document.write(validasenha)</script>";
    // $Senha = "<script>document.write(validasenha)</script>";
    // $teste = strpos($Senha,0);
    // echo $teste;
    // echo "<br>";
    // echo $Senha;
    // echo "<br>";
    // var_dump($teste);
    // if ($Senha == 1)
    // { 
    //     echo "<br>Você deve digitar uma senha que contenha pelo menos: 1 Maiusculo, 1 minusculo e 1 número";
    // }
    ?>
    <?php
?>
</body>
<!-- document.write(validaSenha(senha)) -->
</html>