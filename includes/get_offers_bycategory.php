<?php
require_once('connection.php');

// Check if category parameter is set
if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];

    // Modify your SQL query to filter offers by category
    $sql = "SELECT ... FROM offer INNER JOIN products ON offer.product_id = products.product_id 
    INNER JOIN subcategories ON products.subcategory_id = subcategories.subcategory_id 
    WHERE subcategories.category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedCategory);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // If no category parameter, retrieve all active offers
    $sql = "SELECT ... FROM offer ...";
    $result = $conn->query($sql);
}

// Fetch and organize offer data as needed

// Close the database connection
$conn->close();

// Return JSON data
header('Content-Type: application/json');
echo json_encode($offers); // Replace $offers with your organized offer data
exit;
?>
