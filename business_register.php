<!DOCTYPE html>
<html>
<head>
  <title>Business Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      display: flex;
      align-items: flex-start;
    }

    .categories {
      flex: 0 0 200px;
      margin-right: 20px;
    }

    .categories h2 {
      margin-top: 0;
    }

    .categories ul {
      list-style-type: none;
      padding: 0;
    }

    .categories li {
      margin-bottom: 5px;
    }

    .business-form {
      flex: 1;
    }

    .business-form label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .business-form input[type="text"],
    .business-form textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .business-form select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .business-form input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
    }

    .business-form input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <?php
  // Check if the form was submitted
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $telephone = $_POST['telephone'];
    $url = $_POST['url'];
    $description = $_POST['description'];
    $categories = $_POST['categories'];

    // Connect to the database
    $host = 'localhost';
    $username = 'root';
    $password = '1111';
    $database = 'business_service';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Insert new business into the database
    $insertQuery = "INSERT INTO Businesses (Name, Address, City, Telephone, URL) VALUES ('$name', '$address', '$city', '$telephone', '$url')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
      // Retrieve the generated BusinessID
      $businessID = mysqli_insert_id($conn);

      // Insert category associations into Biz_Categories table
      foreach ($categories as $categoryID) {
        $insertCategoryQuery = "INSERT INTO Biz_Categories (BusinessID, CategoryID) VALUES ('$businessID', '$categoryID')";
        mysqli_query($conn, $insertCategoryQuery);
      }

      // Display success message
      echo '<p>Business registered successfully!</p>';
    } else {
      // Display error message
      echo '<p>Error registering business: ' . mysqli_error($conn) . '</p>';    }

      // Close the database connection
      mysqli_close($conn);
    }
    ?>
  
    <div class="container">
      <!-- Category selection section -->
      <div class="categories">
        <h2>Categories</h2>
        <ul>
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
  
          // Retrieve categories from the database
          $categoryQuery = "SELECT * FROM Categories";
          $categoryResult = mysqli_query($conn, $categoryQuery);
  
          if (mysqli_num_rows($categoryResult) > 0) {
            while ($row = mysqli_fetch_assoc($categoryResult)) {
              echo '<li><input type="checkbox" name="categories[]" value="' . $row['CategoryID'] . '"> ' . $row['Title'] . '</li>';
            }
          }
  
          // Close the database connection
          mysqli_close($conn);
          ?>
        </ul>
      </div>
  
      <!-- Business registration form section -->
      <div class="business-form">
        <h2>Add Business</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <label for="name">Business Name:</label>
          <input type="text" name="name" id="name" required><br>
  
          <label for="address">Address:</label>
          <input type="text" name="address" id="address" required><br>
  
          <label for="city">City:</label>
          <input type="text" name="city" id="city" required><br>
  
          <label for="telephone">Telephone:</label>
          <input type="text" name="telephone" id="telephone" required><br>
  
          <label for="url">URL:</label>
          <input type="text" name="url" id="url" required><br>
  
          <label for="description">Description:</label>
          <textarea name="description" id="description" required></textarea><br>
  
          <label for="categories">Categories:</label>
          <select name="categories[]" id="categories" multiple required>
            <?php
            // Connect to the database
            $conn = mysqli_connect($host, $username, $password, $database);
  
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
  
            // Retrieve categories from the database
            $categoryQuery = "SELECT * FROM Categories";
            $categoryResult = mysqli_query($conn, $categoryQuery);
  
            if (mysqli_num_rows($categoryResult) > 0) {
              while ($row = mysqli_fetch_assoc($categoryResult)) {
                echo '<option value="' . $row['CategoryID'] . '">' . $row['Title'] . '</option>';
              }
            }
  
            // Close the database connection
            mysqli_close($conn);
            ?>
          </select><br><br>
  
          <input type="submit" value="Submit">
        </form>
      </div>
    </div>
  </body>
  </html>