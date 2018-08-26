<!DOCTYPE html5>
<html lang = "pt-br">
  <head>
    <meta charset = "utf-8">
    <!-- css -->
    <link rel = "stylesheet" href = "style/style.css">
    <title>simple_site</title>

    <!-- php functions -->
    <?php
      require_once('funcoes.php');
      $conn = bd_connection();
    ?>

    <script src = "js/jquery.js"></script>

  </head>
  <body>
    <form method = 'POST'>
      Nome Completo:<br>
      <input type = "text" name = "val_nome_completo" value = "" required><br><br>
      Email:<br>
      <input type = "text" name = "val_email" value = "" required><br><br>
      Celular:<br>
      <input type = "text" name = "val_celular" value = "" required><br><br>

      <!-- restrieve states from bd and show as a dropdown section -->
      Estado:<br>
      <?php
        echo "<select name = 'val_estado' id = 'id_val_estado' onChange = 'getIdState(this)'>";
          $query = "SELECT uf FROM estado ORDER BY uf";
          $result = mysqli_query($conn, $query);
          echo "<option disabled selected value> --Selecione um Estado-- </option>";
          while ($rows = mysqli_fetch_array($result)) {
            echo "<option value = '$rows[uf]'>$rows[uf]</option>";
          }
        echo "</select><br><br>";
      ?>

      <script type = 'text/javascript'>
        function getIdState(control) {
          var uf = control.value;
          query = "SELECT nome FROM cidade ORDER BY nome WHERE estado = ";
          query += uf;
          document.getElementById("message").innerHTML = query;
        }
      </script>

      <div id = 'message'>
        
      </div>

      <?php
        // retrieve cities from uf selected before as a dropdown menu
        echo "Cidade:<br>";
        echo "<select name = 'val_cidade'>";
          $query = $_POST["query"];
          echo $query;
          $query = "SELECT nome FROM cidade ORDER BY nome";
          $result = mysqli_query($conn, $query);
          while ($rows = mysqli_fetch_array($result)) {
            echo "<option value = '$rows[nome]'";
            echo ">$rows[nome]";
          }
        echo "</select><br><br>";
      ?>

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

    <!-- print clients -->
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
