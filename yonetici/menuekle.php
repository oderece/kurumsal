<?php
include('../inc/ayar.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_name = $_POST["menu_name"];

    // Prepare an insert statement
    $sql = "INSERT INTO menuler (menu_name) VALUES (?)";

    if ($stmt = $baglanti->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(1, $menu_name);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to menuler page
            header("location: menuler.php");
            exit();
        } else {
            echo "Bir hata oluştu. Lütfen daha sonra tekrar deneyin.";
        }
    }
}

// Close connection
$baglanti = null;
?>
