<html>
<head>
  <title>Categories Table</title>
</head>
<body>
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

  // Fetch all categories from the Categories table
  $sql = "SELECT * FROM Categories";
  $result = $conn->query($sql);

  // Check if any categories exist
  if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>CategoryID</th><th>Title</th><th>Description</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["CategoryID"] . "</td>";
      echo "<td>" . $row["Title"] . "</td>";
      echo "<td>" . $row["Description"] . "</td>";
      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "No categories found.";
  }

  // Close the database connection
  $conn->close();
  ?>

  <h2>Add New Category</h2>
  <form action="add_category.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title" required><br>

    <label for="description">Description:</label>
    <input type="text" name="description" required><br>

    <input type="submit" value="Add Category">
  </form>
</body>
</html>