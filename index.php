<?php
$servername = "localhost";
$username = "root";
$password = "admin";

try {
    $conn = new PDO("mysql:host=$servername;dbname=klant", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["username"];  // from your HTML form name="username"
    $wachtwoord = $_POST["password"]; // from name="password"

    // 3️⃣ Query the database
    $sql = "SELECT * FROM student WHERE email = '$email' AND wachtwoord = '$wachtwoord'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // 4️⃣ Login successful
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $email;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "❌ Incorrect email or password!";
    }
}

$conn->close();
?>
?>






