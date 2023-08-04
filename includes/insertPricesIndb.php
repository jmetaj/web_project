<?php
require_once('connection.php');

// Use __DIR__ to get the absolute path to the 'includes' directory
$scriptDirectory = __DIR__;

// Navigate up one level to reach the 'data' directory
$jsonDataPath = $scriptDirectory . '/../data/product_prices_sample.json';

// Read the JSON file contents
$jsonData = file_get_contents($jsonDataPath);

// Parse the JSON data into a PHP array
$data = json_decode($jsonData, true);

// Extract products from the data
$products = $data['data'];

// Prepare the SQL statements with placeholders for categories, subcategories, products, and prices
$insertProductSql = "INSERT IGNORE INTO products (product_id, product_name, subcategory_id) VALUES (?, ?, ?)";
$stmtProduct = $conn->prepare($insertProductSql);

$insertPriceSql = "INSERT INTO prices (product_id, price_date, price) VALUES (?, ?, ?)";
$stmtPrice = $conn->prepare($insertPriceSql);

// Bind the values to the placeholders in the prepared statements for products and prices
$stmtProduct->bind_param("iss", $product_id, $product_name, $subcategory_id);
$stmtPrice->bind_param("isd", $product_id, $price_date, $price);

// Execute the prepared statements to insert the data for products and prices
foreach ($products as $productData) {
    $product_id = $productData['id'];
    $product_name = $productData['name'];
    $subcategory_id = $productData['subcategory']; // Assuming 'subcategory' key exists in the JSON data

    // Check if the product_id is not empty or null
    if (!empty($product_id)) {
        if ($stmtProduct->execute()) {
            if ($stmtProduct->affected_rows > 0) {
                echo "Product data inserted successfully for product_id: " . $product_id . PHP_EOL;
            } else {
                echo "Product with product_id: " . $product_id . " already exists. Skipped insertion." . PHP_EOL;
            }
        } else {
            echo "Error inserting product data for product_id: " . $product_id . " - " . $stmtProduct->error . PHP_EOL;
        }
    } else {
        echo "Error: product_id is empty or null for product: " . $product_name . PHP_EOL;
    }

    // Insert prices for this product
    if (isset($productData['prices']) && is_array($productData['prices'])) {
        foreach ($productData['prices'] as $priceData) {
            $price_date = $priceData['date'];
            $price = $priceData['price'];

            // Check if the price_date and price are not empty or null
            if (!empty($price_date) && isset($price)) {
                // Check if the product_id is not empty or null
                if (!empty($product_id)) {
                    if ($stmtPrice->execute()) {
                        if ($stmtPrice->affected_rows > 0) {
                            echo "Price data inserted successfully for product_id: " . $product_id . " and date: " . $price_date . PHP_EOL;
                        } else {
                            echo "Price with product_id: " . $product_id . " and date: " . $price_date . " already exists. Skipped insertion." . PHP_EOL;
                        }
                    } else {
                        echo "Error inserting price data for product_id: " . $product_id . " and date: " . $price_date . " - " . $stmtPrice->error . PHP_EOL;
                    }
                } else {
                    echo "Error: product_id is empty or null for price with date: " . $price_date . PHP_EOL;
                }
            } else {
                echo "Error: price_date or price is empty or null for product_id: " . $product_id . PHP_EOL;
            }
        }
    }
}

// Close the prepared statements
$stmtProduct->close();
$stmtPrice->close();

// Close the database connection (you can also close it in connection.php after you finish using it)
$conn->close();
?>
