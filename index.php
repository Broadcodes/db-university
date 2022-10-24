<!-- 
    Utilizzando il database db-university, effettuate delle interrogazioni via PHP e mostrate il risultato in pagina.
    Va bene una lista di qualcosa recuperato dal DB University, quindi libero sfogo alla fantasia!
    Caricate il tutto nella stessa repo di questi giorni (db-university).
 -->

<?php

define("DB_SERVERNAME", "localhost: 3306");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db-university");

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn && $conn->connect_error) {
    echo "Connessione non riuscita: " . $conn->connect_error;
} else {

    $sql = "SELECT `students`.`name` AS `nome_studente`, `students`.`surname` AS `cognome_studente`, `degrees`.`name` AS `corso_di_laurea`, `students`.`email`
                FROM `students`
                INNER JOIN `degrees`
                ON `students`.`degree_id` = `degrees`.`id`
                HAVING `degrees`.`name` LIKE '%Economia';";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        ?>
            <h1>Students enrolled in degree courses</h1>
            <table>
                <thead>
                    <tr>
                        <th>Student name</th>
                        <th>Student surname</th>
                        <th>Degree course</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?= $row["nome_studente"] ?></td>
                        <td><?= $row["cognome_studente"] ?></td>
                        <td><?= $row["corso_di_laurea"] ?></td>
                        <td><?= $row["email"] ?></td>
                    </tr>
            <?php
        }
            ?>
                </tbody>
            </table>
            <?php
    } elseif ($result) {
        echo "0 results";
    } else {
        echo "query error";
    }

    $conn->close();
}

?>

<style>
    h1{
        color: #0A528F;
    }

    table{
        padding: 20px;
        border-collapse: collapse;
    }

    th,
    td{
        text-align: left;
        padding: 10px;
        padding-left: 30px;
    }

    th{
        color: #0A528F;
        background: rgb(255,255,255);
        background: linear-gradient(180deg, rgba(255,255,255,0.3449754901960784) 0%, rgba(205,205,205,1) 100%);
    }

    tbody>tr:nth-child(even){
        background-color: #D8D8D8;
    }


</style>