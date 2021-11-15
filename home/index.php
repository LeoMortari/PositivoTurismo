<?php

include_once '../db_connect.php';

//Header
include_once 'includes/header.php';

// Mensagem
include_once 'includes/menssage.php';

function InverteData($data)
                    {
                        $dataNormal = explode("-", $data);
                        $dataBanco = $dataNormal[2] . "/" . $dataNormal[1] . "/" . $dataNormal[0];
                        return $dataBanco;
                    }
?>
<div class="container" style="display: flex;">
    <div class="col s12 m6 push-m3">
        <h3 class="light">Clientes</h3>
        <table class="striped">
            <br>
            <a href="adicionar.php" class="btn waves-effect waves-light">Adicionar Cliente</a><br><br>
            <form action="">
            <div class="input-field col m6">
          <i class="material-icons prefix ">search</i>
          <input placeholder="Nome, CPF ou qualquer coisa que envolva o cadastro do cliente" name="search" id="pesquisar" type="text" class="validate ">
          <label for="pesquisar">Pesquisar</label>
          <button type="submit" class="btn blue waves-effect waves-light" >Buscar</button>
          </div>
        </form>
            <thead>
                <tr>
                    <th>Nome:</th>
                    <th>CPF:</th>
                    <th>Email:</th>
                    <th>UF:</th>
                    <th>Data de Nascimento:</th>
                    <th>Logradouro:</th>
                    <th>Passaporte:</th>
                    <th>usuario:</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['search']) && $_GET['search'] != null ){
                $busca = mysqli_escape_string($connect, $_GET['search']);
                if (strpos($busca,'/')){
                    $data = explode("/", $busca);
                    $count = count($data);
                    if (!isset($data[$count - 3])) {
                        $data[$count - 3] = '';
                        $busca = $data[$count - 3] .'-'. $data[$count - 1] .'-'. $data[$count - 2];
                        global $busca;
                    } else {
                    $busca = $data[$count - 1] .'-'. $data[$count - 2 ] .'-'. $data[$count - 3];
                    global $busca;
                    }
                }
                $sql_code = "SELECT * FROM cliente WHERE nome LIKE '%$busca%'
                OR cpf LIKE '%$busca%'
                OR email LIKE'%$busca%'
                OR uf LIKE'%$busca%'
                OR dataNascimento LIKE'%$busca%'
                OR logradouro LIKE'%$busca%'
                OR passaporte LIKE'%$busca%'
                OR usuario LIKE'%$busca%'";

                $result = mysqli_query($connect, $sql_code);
                if (mysqli_num_rows($result) > 0){
                    while ($dados = mysqli_fetch_assoc($result) ) {
                        if ($dados['usuario'] == 'admin') {
                            ?>
                            <tr>
                            <td><?php echo $dados['nome']; ?></td>
                            <td><?php echo $dados['cpf']; ?></td>
                            <td><?php echo $dados['email']; ?></td>
                            <td><?php echo $dados['uf']; ?></td>
                            <td><?php
                                $data = $dados['dataNascimento'];
                                echo InverteData($data)
                                ?></td>
                            <td><?php echo $dados['logradouro']; ?></td>
                            <td><?php echo $dados['passaporte']; ?></td>
                            <td><?php echo $dados['usuario']; ?></td>
  
                        </tr>

                        <?php
                         } else {
                             ?>
                        <tr>
                   <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['cpf']; ?></td>
                        <td><?php echo $dados['email']; ?></td>
                        <td><?php echo $dados['uf']; ?></td>
                        <td><?php
                            $data = $dados['dataNascimento'];
                            echo InverteData($data)
                            ?></td>
                        <td><?php echo $dados['logradouro']; ?></td>
                        <td><?php echo $dados['passaporte']; ?></td>
                        <td><?php echo $dados['usuario']; ?></td>
                        <td><a href="editar.php?id=<?php echo $dados['id']; ?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>
                            <td><a href="#modal<?php echo $dados['id']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>
                    <div id="modal<?php echo $dados['id']; ?>" class="modal">
                                <div class="modal-content">
                                    <h4>Tem certeza?</h4>
                                    <p>Deseja excluir <?php echo $dados['nome']; ?>? </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="php_action/delete.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
                                        <button type="submit" name="btn-deletar" class="btn red">Sim, quero deletar</button>
                                        <a href="#!" class="modal-close btn-flat">Cancelar</a>
                                    </form>
                                </div>
                            </div>
                    </tr>
                    <?php
                }}
                    } else {
                        echo "<tr>
                        <td class='col s12'><strong>Nenhum resultado encontrado</strong></td>
                    </tr>";
                    }

                } else {
                if(!isset($_GET['search']) or $_GET['search'] == null ){
                $sql = "SELECT * FROM cliente";
                $resultado = mysqli_query($connect, $sql);

                if (mysqli_num_rows($resultado) > 0) {

                    while ($dados = mysqli_fetch_array($resultado)) {
                        if ($dados['usuario'] == 'admin') {
                            ?>
                            <tr>
                            <td><?php echo $dados['nome']; ?></td>
                            <td><?php echo $dados['cpf']; ?></td>
                            <td><?php echo $dados['email']; ?></td>
                            <td><?php echo $dados['uf']; ?></td>
                            <td><?php
                                $data = $dados['dataNascimento'];
                                echo InverteData($data)
                                ?></td>
                            <td><?php echo $dados['logradouro']; ?></td>
                            <td><?php echo $dados['passaporte']; ?></td>
                            <td><?php echo $dados['usuario']; ?></td>
  
                        </tr>
                        <?php
                        } else {

                ?>
                        <tr>
                            <td><?php echo $dados['nome']; ?></td>
                            <td><?php echo $dados['cpf']; ?></td>
                            <td><?php echo $dados['email']; ?></td>
                            <td><?php echo $dados['uf']; ?></td>
                            <td><?php
                                $data = $dados['dataNascimento'];
                                echo InverteData($data)
                                ?></td>
                            <td><?php echo $dados['logradouro']; ?></td>
                            <td><?php echo $dados['passaporte']; ?></td>
                            <td><?php echo $dados['usuario']; ?></td>
                            <td><a href="editar.php?id=<?php echo $dados['id']; ?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>
                            <td><a href="#modal<?php echo $dados['id']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

                            <div id="modal<?php echo $dados['id']; ?>" class="modal">
                                <div class="modal-content">
                                    <h4>Tem certeza?</h4>
                                    <p>Deseja excluir <?php echo $dados['nome']; ?>? </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="php_action/delete.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
                                        <button type="submit" name="btn-deletar" class="btn red">Sim, quero deletar</button>
                                        <a href="#!" class="modal-close btn-flat">Cancelar</a>
                                    </form>
                                </div>
                            </div>
                        </tr>
                    <?php }
            } } else { ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                <?php }}} ?>
            </tbody>
        </table>
        <br>
    </div>
</div>

<?php
//Footer
include_once 'includes/footer.php';
?>
