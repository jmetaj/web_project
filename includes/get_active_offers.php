<?php
require_once('connection.php');
// Get the search keyword from the query string (if provided)
$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

// Modify the SQL query to include the search keyword
$sql = "SELECT store_name, latitude, longitude FROM store 
INNER JOIN offer ON store.store_id = offer.store_id WHERE offer.active = 1 AND store_name LIKE '%$searchKeyword%'";
$result = $conn->query($sql);

$storesWithOffers = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $store = [
            "lat" => $row["latitude"],
            "lon" => $row["longitude"],
            "name" => $row["store_name"],
            "offer" => "Active Offer" // Provide a default offer message
        ];
        $storesWithOffers[] = $store;
    }
} else {
    echo "No active offers found.";
}

// Close the database connection
$conn->close();

// Return JSON data
header('Content-Type: application/json');
echo json_encode($storesWithOffers);
exit;

?>


