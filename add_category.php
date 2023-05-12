<?php
$servername = "localhost";
$username = "root";
$password = "1111";
$database = "business_service";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST["title"];
  $description = $_POST["description"];

  // Prepare and execute the SQL statement
  $stmt = $conn->prepare("INSERT INTO Categories (Title, Description) VALUES (?, ?)");
  $stmt->bind_param("ss", $title, $description);
  
  if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: index.php?message=success");
    exit();
  } else {
    $stmt->close();
    $conn->close();
    header("Location: index.php?message=error");
    exit();
  }
}
?>