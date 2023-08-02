<?php
require_once('connection.php');

// Use __DIR__ to get the absolute path to the 'includes' directory
$scriptDirectory = __DIR__;

// Navigate up one level to reach the 'data' directory
$jsonDataPath = $scriptDirectory . '/../data/products_and_categories.json';

// Read the JSON file contents
$jsonData = file_get_contents($jsonDataPath);

// Parse the JSON data into a PHP array
$data = json_decode($jsonData, true);

// Extract products and categories from the data
$products = $data['products'];
$categories = $data['categories'];


// Step 2: Prepare the SQL statements with placeholders for categories and subcategories
$insertCategorySql = "INSERT INTO categories (category_id, category_name) VALUES (?, ?)";
$stmtCategory = $conn->prepare($insertCategorySql);

$insertSubcategorySql = "INSERT INTO subcategories (subcategory_id, subcategory_name, category_id) VALUES (?, ?, ?)";
$stmtSubcategory = $conn->prepare($insertSubcategorySql);

// Step 3: Bind the values to the placeholders in the prepared statements
$stmtCategory->bind_param("ss", $category_id, $category_name);
$stmtSubcategory->bind_param("sss", $subcategory_id, $subcategory_name, $category_id);

// Step 4: Execute the prepared statements to insert the data
foreach ($categories as $category) {
    $category_id = $category['id'];
    $category_name = $category['name'];

    // Check if the category_id is not empty or null
    if (!empty($category_id)) {
        if ($stmtCategory->execute()) {
            echo "Category data inserted successfully for category_id: " . $category_id . PHP_EOL;
        } else {
            echo "Error inserting category data for category_id: " . $category_id . " - " . $stmtCategory->error . PHP_EOL;
        }

        // Insert subcategories for this category
        foreach ($category['subcategories'] as $subcategory) {
            $subcategory_id = $subcategory['uuid'];
            $subcategory_name = $subcategory['name'];

            // Check if the subcategory_id is not empty or null
            if (!empty($subcategory_id)) {
                if ($stmtSubcategory->execute()) {
                    echo "Subcategory data inserted successfully for subcategory_id: " . $subcategory_id . PHP_EOL;
                } else {
                    echo "Error inserting subcategory data for subcategory_id: " . $subcategory_id . " - " . $stmtSubcategory->error . PHP_EOL;
                }
            } else {
                echo "Error: subcategory_id is empty or null for subcategory: " . $subcategory_name . PHP_EOL;
            }
        }
    } else {
        echo "Error: category_id is empty or null for category: " . $category_name . PHP_EOL;
    }
}

// Close the prepared statements
$stmtCategory->close();
$stmtSubcategory->close();

// Close the database connection (you can also close it in connection.php after you finish using it)
$conn->close();
?>