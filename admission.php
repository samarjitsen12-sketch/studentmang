<?php

include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $age = $_POST["age"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $class = $_POST["class"];

    $sql = "INSERT INTO new_admission
            (name, age, dob, gender, address, class_no)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sisssi",
        $name,
        $age,
        $dob,
        $gender,
        $address,
        $class
    );

    if ($stmt->execute()) {
        echo "<h2>Student record saved successfully!</h2>";
        echo "<p>You will be redirected to the home page in 10 seconds.</p>";
        echo "School will contact you soon for further details. Thank you for choosing our school!";
        header("Refresh:10; url=index.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>