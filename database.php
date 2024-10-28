<?php
    $dbServer = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "ecom";
    $conn =  "";
    try {
        $conn = mysqli_connect($dbServer, $dbUser,$dbPass,$dbName);
/*         echo
        "<script>
        console.log('Connected to database.');
        </script>"; */
    } catch (mysqli_sql_exception) {
/*         echo
        "<script>
        console.log('Something is wrong in the database.');
        </script>"; */
    };
?>  