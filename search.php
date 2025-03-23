<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aroinsa";

$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Form submission handling
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];

    // Perform a database query to retrieve the link associated with the search query
    $sql = "SELECT link FROM search WHERE search_query LIKE '%$search_query%'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // If search query matches, fetch the link from the database
        $row = $result->fetch_assoc();
        $link = $row['link'];

        // Check if the current page is article.php
        if (strpos($link, 'article.php') !== false) {
            // Redirect to article page with fragment identifier (specific article section)
            header("Location: $link#$search_query");
        } else {
            // For other pages, redirect to the link as usual
            header("Location: $link");
        }
        exit(); // Terminate the script after redirection
    } else {
        // If search query doesn't match, display a message or perform another action
        echo "No results found";
    }
}

$con->close();
?>
