<?php
  function bd_connection () {
    $conn = mysqli_connect("localhost", "root", "", "simple_forum");

    if (!$conn) {
        echo "Error: Can't connect to to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return($conn);
    //mysqli_close($link);
  }
?>
