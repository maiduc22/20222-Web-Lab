<!DOCTYPE html>
<html>
<head>
    <title>Category Administration</title>
</head>
<body>
    <h2>Add Category</h2>
    <form method="POST" action="">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <br><br>
        <input type="submit" name="add_category" value="Add Category">
    </form>

    <h2>List of Categories</h2>
    <?php
    // PHP code to handle form submission and listing of categories

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "1111";
    $database = "business"; // Replace with your actual database name

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle form submission to add a category
    if (isset($_POST['add_category'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];

        // Generate a unique CategoriesID value (example: using a timestamp)
        $categoriesID = time();

        // Insert the category into the database
        $sql = "INSERT INTO categories (CategoriesID, Title, Description) VALUES ('$categoriesID', '$title', '$description')";
        if ($conn->query($sql) === TRUE) {
            echo "Category added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // List all categories
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>".$row['Title'].": ".$row['Description']."</li>";
        }
        echo "</ul>";
    } else {
        echo "No categories found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>