<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="leadstyle.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>leaderboard</title>
</head>
<body>

    <?php
    require_once('leadData.php');
    ?>
    <div>
    <?php

    $ranking = 1;
    echo "<table>"; // start a table tag in the HTML
   echo "<tr><th>Ranking</th>
        <th>user</th>
        <th>high score</th>
        </tr>
        <tr>";
    while ($row = mysqli_fetch_array($res)) {
        echo " 
        <td>{$ranking}</td>
        <td>{$row['username']}</td>
        <td>{$row['scores']}</td>
        </tr>
";
        $ranking++;
    }

    echo "</table>"
    ?>
    </div>

</body>
</html>