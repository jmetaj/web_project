
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="../includes/proccess.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
    
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <br>
    
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
    
        <input type="submit" value="Register">
    </form>
    
    
</body>
</html>