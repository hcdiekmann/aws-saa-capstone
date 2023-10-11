 <a href="query.php">Pick another query</a>

 <?php
        //Query to get the GDP
        $sql = "select name, gdp from countrydata_final;";
        $conn = new mysqli($_SESSION['ep'], $_SESSION['un'], $_SESSION['pw'], $_SESSION['db']);
        if ($conn->connect_error) {
            error_log('Connection error: ' . $conn->connect_error);
            var_dump('Connection error: ' . $conn->connect_error);
        }
        else {
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {

              echo '<table style="width: 80%">';
              echo '<tr>';
              echo '<th style="text-align:left">This is a Country Name</th>';
              echo '<th style="text-align:left">Gross Domestic Product</th>';
              echo '</tr>';

              while($row = $result->fetch_assoc()) {

              echo '<tr>';
              echo '<td>';
              echo $row["name"];
              echo '&nbsp';
              echo '<td>';
              echo $row["gdp"];
              echo '&nbsp';
              echo '<br>';
              echo '</tr>';
              }
              echo '</table>';
            }
        }


    ?>
