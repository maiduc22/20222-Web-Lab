<html>
<head>
  <title>Business Registration</title>
  <style>
    body {
      display: flex;
      align-items: flex-start;
    }

    .category-list {
      width: 200px;
      padding: 20px;
      background-color: #f1f1f1;
    }

    .category-list h2 {
      margin-top: 0;
    }

    .business-form {
      flex-grow: 1;
      padding: 20px;
    }

    .business-form label {
      display: block;
      margin-bottom: 10px;
    }

    .business-form input[type="text"],
    .business-form textarea {
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
    }

    .business-form input[type="submit"] {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="category-list">
    <h2>Categories</h2>
    <ul>
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

      // Display categories as checkboxes
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<li><input type="checkbox" name="categories[]" value="' . $row["CategoryID"] . '"> ' . $row["Title"] . '</li>';
        }
      } else {
        echo "No categories found.";
      }

      // Close the database connection
      $conn->close();
      ?>
    </ul>
  </div>

  <div class="business-form">
    <h2>Add Business</h2>
    <form action="add_business.php" method="POST">
      <label for="name">Name:</label>
      <input type="text" name="name" required>

      <label for="address">Address:</label>
      <input type="text" name="address" required>

      <label for="city">City:</label>
      <input type="text" name="city" required>

      <label for="telephone">Telephone:</label>
      <input type="text" name="telephone" required>

      <label for="url">URL:</label>
      <input type="text" name="url">

      <label for="description">Description:</label>
      <textarea name="description" rows="5" required></textarea>

      <input type="submit" value="Register Business">
    </form>
  </div>
</body>
</html>