<!DOCTYPE html>
<html>
<head>
  <title>Categories</title>
  <style>
    table {
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid black;
      padding: 5px;
    }
  </style>
</head>
<body>
  <?php
    // Connect to the database
    $host = 'localhost';
    $username = 'root';
    $password = '1111';
    $database = 'business_service';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Retrieve form data
      $title = $_POST['title'];
      $description = $_POST['description'];

      // Insert new category into the database
      $insertQuery = "INSERT INTO Categories (Title, Description) VALUES ('$title', '$description')";
      $insertResult = mysqli_query($conn, $insertQuery);

      
    }

    // Query the categories
    $query = "SELECT * FROM Categories";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      // Create the table header
      echo '<table>';
      echo '<tr><th>Category ID</th><th>Title</th><th>Description</th></tr>';

      // Fetch and display each category
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['CategoryID'] . '</td>';
        echo '<td>' . $row['Title'] . '</td>';
        echo '<td>' . $row['Description'] . '</td>';
        echo '</tr>';
      }

      echo '</table>';
    } else {
      echo 'No categories found.';
    }

    // Close the database connection
    mysqli_close($conn);
  ?>

  <h2>Add a new category</h2>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required><br><br>
    <label for="description">Description:</label>
    <input type="text" name="description" id="description" required><br><br>
    <input type="submit" value="Add Category">
  </form>
</body>
</html>