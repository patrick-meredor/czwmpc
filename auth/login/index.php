<?php 
session_start();

require_once "../config/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if(password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];

            header("Location: dashboard/index.php");
            exit();
        } else {
            echo "Incorrect Password";
        }
    } else {
        echo "We failed to find an account with that email";
    }

    $stmt->close();
    $conn->close();
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Czwmpc | Login</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Welcome Back</h1>
        <form class="flex flex-col gap-4" method="post" action="../../config/login-config.php">
            <div class="flex flex-col gap-1">
                <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" required class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
            </div>
            <div class="flex flex-col gap-1">            
                <div class="flex justify-between items-center">
                    <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                    <a href="#" class="text-xs text-blue-600 hover:underline">Forgot password?</a>
                </div>
                <input type="password" name="password" id="password" required class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
            </div>

            <button type="submit" class="bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition-colors shadow-md mt-2">
                Sign In
            </button>
        </form>
        <p class="text-center text-gray-600 mt-6 text-sm">
            Don't have an account? <a href="../register/index.php" class="text-blue-600 font-semibold hover:underline">Register here</a>
        </p>
    </div>
</body>
</html>