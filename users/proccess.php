<?php
require_once('connection.php');
?>

<?php
if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password using bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users(username, email, password) VALUES(?, ?, ?)";

    $stmtinsert = $conn->prepare($sql);
    // Bind the values to the placeholders and execute
    $stmtinsert->bind_param("sss", $username, $email, $hashedPassword);
    $result = $stmtinsert->execute();
    if ($result) {
        echo "Successfully saved";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the statement
   // $stmtinsert->close();
   mysqli_close($conn);
}
?>
