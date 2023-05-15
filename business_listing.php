<!DOCTYPE html>
<html>
<head>
  <title>Business Listing</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      align-items: flex-start;
      max-width: 960px;
      margin: 0 auto;
      padding: 20px;
    }

    .categories {
      flex: 0 0 200px;
      margin-right: 20px;
      background-color: #ffffff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      padding: 10px;
    }

    .categories h2 {
      margin-top: 0;
      font-size: 18px;
    }

    .categories ul {
      list-style-type: none;
      padding: 0;
    }

    .categories li {
      margin-bottom: 5px;
    }

    .categories a {
      text-decoration: none;
      color: #333333;
      display: block;
      padding: 5px 10px;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    .categories a:hover {
      background-color: #f9f9f9;
    }

    .businesses {
      flex: 1;
      background-color: #ffffff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      padding: 10px;
    }

    .businesses h2 {
      margin-top: 0;
      font-size: 18px;
    }

    .businesses ul {
      list-style-type: none;
      padding: 0;
    }

    .businesses li {
      margin-bottom: 15px;
      padding: 10px;
      border-radius: 4px;
      background-color: #f9f9f9;
    }

    .businesses li:hover {
      background-color: #f1f1f1;
    }

    .businesses li h3 {
      margin-top: 0;
      font-size: 16px;
      margin-bottom: 5px;
    }

    .businesses li p {
      margin-bottom: 5px;
      font-size: 14px;
    }

    .businesses li p strong {
      font-weight: bold;
    }

    .businesses li p a {
      color: #3366cc;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Category selection section -->
    <div class="categories">
      <h2>Categories</h2>
      <ul>
        <li><a href="business_listing.php">All Categories</a></li>
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
              echo '<li><a href="business_listing.php?category=' . $row['CategoryID'] . '">' . $row['Title'] . '</a></li>';
            }
          } else {
            echo '<li>No categories found.</li>';
          }
  
          // Close the database connection
          mysqli_close($conn);
          ?>
        </ul>
      </div>
  
      <!-- Business listing section -->
      <div class="businesses">
        <h2>Businesses</h2>
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
  
          // Retrieve businesses from the database based on the selected category (if any)
          $categoryID = $_GET['category'] ?? null;
  
          if ($categoryID) {
            $businessQuery = "SELECT * FROM Businesses 
                              INNER JOIN Biz_Categories ON Businesses.BusinessID = Biz_Categories.BusinessID 
                              WHERE Biz_Categories.CategoryID = '$categoryID'";
          } else {
            $businessQuery = "SELECT * FROM Businesses";
          }
  
          $businessResult = mysqli_query($conn, $businessQuery);
  
          if (mysqli_num_rows($businessResult) > 0) {
            while ($row = mysqli_fetch_assoc($businessResult)) {
              echo '<li>';
              echo '<h3>' . $row['Name'] . '</h3>';
              echo '<p><strong>Address:</strong> ' . $row['Address'] . '</p>';
              echo '<p><strong>City:</strong> ' . $row['City'] . '</p>';
              echo '<p><strong>Telephone:</strong> ' . $row['Telephone'] . '</p>';
              echo '<p><strong>URL:</strong> <a href="' . $row['URL'] . '">' . $row['URL'] . '</a></p>';

              echo '</li>';
            }
          } else {
            echo '<li>No businesses found.</li>';
          }
  
          // Close the database connection
          mysqli_close($conn);
          ?>
        </ul>
      </div>
    </div>
  </body>
  </html>