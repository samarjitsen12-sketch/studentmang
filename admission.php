<?php
    include "db_connect.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $roll_no = $_POST["roll"];

        $sql = "INSERT INTO students (name, roll_no) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $name, $roll_no);
       if ($stmt->execute()) {
    echo "<h2>Student record saved successfully!</h2>";
    header("Refresh: 10; URL=index.html");
            exit();
} 
else {
    echo "Error: " . $stmt->error;
    header("Refresh: 10; URL=index.html");
            exit();
}
    }

$conn->close();
?>