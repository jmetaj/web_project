<?php
require_once('connection.php');

// Query to retrieve stores with active offers
$sql = "SELECT store_name, latitude, longitude FROM store INNER JOIN offer ON store.store_id = offer.store_id WHERE offer.active = 1";
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


