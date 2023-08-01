<?php
// Include the database connection file (config.php)
include 'connection.php';

// Check if the latitude and longitude parameters are set
if (isset($_GET['lat']) && isset($_GET['lng'])) {
// Get the user's latitude and longitude from the query parameters
$latitude = $_GET['lat'];
$longitude = $_GET['lng'];

try {
  // Prepare the SQL statement to retrieve stores with active offers
  $sql = "SELECT store_name, latitude, longitude FROM store WHERE store_id IN (SELECT store_id FROM offer WHERE active = 1)";
  $result = mysqli_query($conn, $sql);

  // Check if the query was successful
  if ($result && mysqli_num_rows($result) > 0) {
    // Fetch all the rows into an associative array
    $storesData = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Return the store data as a JSON response
    header('Content-Type: application/json');
    echo json_encode($storesData);
  } else {
    // If no stores with active offers were found
    echo "No stores with active offers found.";
  }

} catch (Exception $e) {
  // Handle any exceptions or errors that occur
  echo "Error: " . $e->getMessage();
}
}else {
    // If latitude and longitude parameters are not provided in the URL
    echo "Latitude and longitude parameters are missing.";
  }
// Close the database connection (optional but recommended)
mysqli_close($conn);
?>
