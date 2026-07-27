<?php

include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $name = $_GET["name"];
    $roll_no = $_GET["roll"];

    $sql = "SELECT * FROM students WHERE name = ? AND roll_no = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $name, $roll_no);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            $name = $row["name"];
            $roll_no = $row["roll_no"];

            // Use the variables here
            echo "Name: $name <br>";
            echo "Roll No: $roll_no <br><br>";
            header("Refresh: 10; URL=index.html");
            exit();
        }

    } else {
        echo "<h2>Student not found.</h2>";
        header("Refresh: 10; URL=index.html");
            exit();
    }

    $stmt->close();

}

$conn->close();
?>