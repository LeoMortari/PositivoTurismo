<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teste</title>
</head>

<body>
  <form action="" method="post">
    <input type="text" id="senha" name="senha"></input>
    <input type="text" hidden name="input" id="input">
    <button type="submit" onclick=Senha()>Form</button>
  </form>

  <script>
    const MAIUSCULA = new Set('ABCDEFGHIJKLMNOPQRSTUVWXYZ')
    const MINUSCULA = new Set('abcdefghijklmnopqrstuvwxyz')

    function isNumber(c) {
      return c === '' + Number(c)
    }

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

    function Senha() {
      let id = document.getElementById("senha").value;
      let passwd = validaSenha(id)
      if (passwd == 0) {
        passwd = 0
        document.getElementById("input").value = 0;
      } else {
        passwd = 1
        document.getElementById("input").value = 1;
      }
      return passwd
    }
  </script>
  <?php
  if (isset($_POST['input'])) {
    $teste = $_POST['input'];
    if ($teste == 0) {
      echo "<li style='color:red'>Você deve digitar uma senha que contenha pelo menos: 1 Maiusculo, 1 minusculo e 1 número</li>";
    } else {
      echo "Senha ok!";
    }
  }
  session_unset();
  ?>
</body>

</html>