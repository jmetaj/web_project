<?php
// Include the connection file to your database
include('connection.php');

// Use __DIR__ to get the absolute path to the directory containing the script
$scriptDirectory = __DIR__;

// Navigate to the 'data' directory and find the GeoJSON file
$jsonDataPath = $scriptDirectory . '/stores.geojson';

// Read the GeoJSON file contents
$geojsonData = file_get_contents($jsonDataPath);

// Parse the GeoJSON data into a PHP array
$data = json_decode($geojsonData, true);

// Extract store information from the GeoJSON data
$stores = $data['features'];

// Prepare the SQL statement with placeholders for store_name, latitude, and longitude
$insertStoreSql = "INSERT INTO store (store_name, latitude, longitude) VALUES (?, ?, ?)";
$stmtStore = $conn->prepare($insertStoreSql);

// Bind the values to the placeholders in the prepared statement
$stmtStore->bind_param("sdd", $store_name, $latitude, $longitude);

// Execute the prepared statement to insert the data for stores
foreach ($stores as $storeData) {
    if ($storeData['type'] === 'Feature' && isset($storeData['geometry']['coordinates']) && isset($storeData['properties']['name'])) {
        $store_name = $storeData['properties']['name'];
        $latitude = $storeData['geometry']['coordinates'][1];
        $longitude = $storeData['geometry']['coordinates'][0];

        // Check if the store_name, latitude, and longitude are not empty or null
        if (!empty($store_name) && isset($latitude) && isset($longitude)) {
            if ($stmtStore->execute()) {
                if ($stmtStore->affected_rows > 0) {
                    echo "Store data inserted successfully for store: " . $store_name . PHP_EOL;
                } else {
                    echo "Store with name: " . $store_name . " already exists. Skipped insertion." . PHP_EOL;
                }
            } else {
                echo "Error inserting store data for store: " . $store_name . " - " . $stmtStore->error . PHP_EOL;
            }
        } else {
            echo "Error: store_name, latitude, or longitude is empty or null for store: " . $store_name . PHP_EOL;
        }
    }
}

// Close the prepared statement
$stmtStore->close();

// Close the database connection (you can also close it in connection.php after you finish using it)
$conn->close();
?>
