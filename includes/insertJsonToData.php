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


// Prepare the SQL statements with placeholders for categories, subcategories, and products
$insertCategorySql = "INSERT IGNORE INTO categories (category_id, category_name) VALUES (?, ?)";
$stmtCategory = $conn->prepare($insertCategorySql);

$insertSubcategorySql = "INSERT IGNORE INTO subcategories (subcategory_id, subcategory_name, category_id) VALUES (?, ?, ?)";
$stmtSubcategory = $conn->prepare($insertSubcategorySql);

$insertProductSql = "INSERT IGNORE INTO products (product_id, product_name, subcategory_id) VALUES (?, ?, ?)";
$stmtProduct = $conn->prepare($insertProductSql);

// Bind the values to the placeholders in the prepared statements for categories and subcategories
$stmtCategory->bind_param("ss", $category_id, $category_name);
$stmtSubcategory->bind_param("sss", $subcategory_id, $subcategory_name, $category_id);

// Execute the prepared statements to insert the data for categories and subcategories
foreach ($categories as $category) {
    $category_id = $category['id'];
    $category_name = $category['name'];

     // Check if the category_id is not empty or null
     if (!empty($category_id)) {
        if ($stmtCategory->execute()) {
            if ($stmtCategory->affected_rows > 0) {
                echo "Category data inserted successfully for category_id: " . $category_id . PHP_EOL;
            } else {
                echo "Category with category_id: " . $category_id . " already exists. Skipped insertion." . PHP_EOL;
            }
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
                    if ($stmtSubcategory->affected_rows > 0) {
                        echo "Subcategory data inserted successfully for subcategory_id: " . $subcategory_id . PHP_EOL;
                    } else {
                        echo "Subcategory with subcategory_id: " . $subcategory_id . " already exists. Skipped insertion." . PHP_EOL;
                    }
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

$stmtProduct = $conn->prepare($insertProductSql);

if ($stmtProduct === false) {
    die("Error preparing the product SQL statement: " . $conn->error);
}   

echo "Debugging: Prepared SQL statement: " . $insertProductSql . PHP_EOL;

// Bind the values to the placeholders in the prepared statement for products
$stmtProduct->bind_param("sss", $product_id, $product_name, $subcategory_id);


// Execute the prepared statement to insert the data for products
foreach ($products as $product) {
    $product_id = $product['id'];
    $product_name = $product['name'];
    $category_id = $product['category'];
    $subcategory_id = $product['subcategory'];

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

}

//Close the prepared statements
$stmtCategory->close();
$stmtSubcategory->close();
$stmtProduct->close();

// Close the database connection (you can also close it in connection.php after you finish using it)
$conn->close();
?>
