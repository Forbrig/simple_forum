<!DOCTYPE html5>
<html lang = "pt-br">
  <head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" href = "style/style.css">
    <title>simple_site</title>

    <?php
      require_once('funcoes.php');
      $conn = bd_connection();
    ?>

  </head>
  <body>
    <form method = 'POST'>
      Nome Completo:<br>
      <input type = "text" name = "val_nome_completo" value = "" required><br><br>
      Email:<br>
      <input type = "text" name = "val_email" value = "" required><br><br>
      Celular:<br>
      <input type = "text" name = "val_celular" value = "" required><br><br>
      Estado:<br>
      <!-- restrieve states from bd and show as a dropdown section -->
      <select name = 'val_estado'>
      <?php
        $query = "SELECT sigla FROM estados ORDER BY descricao";
        $result = mysqli_query($conn, $query);
        while ($rows = mysqli_fetch_array($result)) {
          echo "<option value = '$rows[sigla]'";
          echo ">$rows[sigla]";
        }
      ?>
      </select><br><br>
      Cidade:<br>
      <input type = "text" name = "val_cidade" value = "" required><br><br>
      <input type = "submit" name = "val_cadastro" value = "Cadastrar">
    </form>

    <?php
      if (isset($_POST['val_cadastro'])) {
        $val_nome_completo = $_POST['val_nome_completo'];
        $val_email = $_POST['val_email'];
        $val_celular = $_POST['val_celular'];
        $val_estado = $_POST['val_estado'];
        $val_cidade = $_POST['val_cidade'];
        $query = "INSERT INTO cliente (nome_completo, email, celular, estado, cidade) VALUES ('$val_nome_completo', '$val_email', '$val_celular', '$val_estado', '$val_cidade')";
        $result = mysqli_query($conn, $query);
      }
    ?>

    <table border = "1" style = "width: 100%">
      <tr>
        <th>Nome Completo</th>
        <th>Email</th>
        <th>Celular</th>
        <th>Estado</th>
        <th>Cidade</th>
        <th>Cadastrado em</th>
        <th>Excluir</th>
      </tr>

      <?php
        $query = "SELECT nome_completo, email, celular, estado, cidade, data_cadastro FROM cliente";
        $result = mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "
              <tr>
                <td>" . $row['nome_completo'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['celular'] . "</td>
                <td>" . $row['estado'] . "</td>
                <td>" . $row['cidade'] . "</td>
                <td>" . $row['data_cadastro'] . "</td>
                <td align = 'center'><form><input type = submit value = 'Excluir' style = 'width: 100%'></form></td>
              </tr>
            ";
          }
        }
      ?>

    </table>

  </body>
</html>
