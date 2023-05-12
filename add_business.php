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
  $name = $_POST["name"];
  $address = $_POST["address"];
  $city = $_POST["city"];
  $telephone = $_POST["telephone"];
  $url = $_POST["url"];
  $description = $_POST["description"];
  
  // Check if categories field is set and not empty
  if (isset($_POST["categories"]) && !empty($_POST["categories"])) {
    $categories = $_POST["categories"];
  } else {
    $categories = array(); // Set empty array if no categories selected
  }

  // Prepare and execute the SQL statement to insert the business
  $stmt = $conn->prepare("INSERT INTO Businesses (Name, Address, City, Telephone, URL, Description) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $name, $address, $city, $telephone, $url, $description);

  // Check if the business is added successfully
  if ($stmt->execute()) {
    // Get the generated BusinessID
    $businessId = $stmt->insert_id;

    // Prepare and execute the SQL statement to insert the business categories
    $stmtCategories = $conn->prepare("INSERT INTO Biz_Categories (BusinessID, CategoryID) VALUES (?, ?)");

    // Iterate through the selected categories and insert them into Biz_Categories table
    foreach ($categories as $categoryId) {
      $stmtCategories->bind_param("ii", $businessId, $categoryId);
      $stmtCategories->execute();
    }

    $stmtCategories->close();
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