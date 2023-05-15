<!DOCTYPE html>
<html>
<head>
  <title>Categories</title>
  <style>
    table {
      border-collapse: collapse;
      margin-bottom: 20px;
      width: 100%;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    h2 {
      margin-top: 20px;
    }

    form {
      max-width: 400px;
      margin: 20px auto;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .success-message {
      color: green;
      margin-top: 10px;
    }

    .error-message {
      color: red;
      margin-top: 10px;
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

      if ($insertResult) {
        echo '<p class="success-message">New category inserted successfully.</p>';
      } else {
        echo '<p class="error-message">Error inserting category: ' . mysqli_error($conn) . '</p>';
      }
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
      echo '<p>No categories found.</p>';
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