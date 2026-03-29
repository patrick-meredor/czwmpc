<?php 
session_start();
require_once '../app/includes/db.php'; 

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
            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Incorrect Password";
        }
    } else {
        $error = "We failed to find an account with that email";
    }
}

$pageTitle = "Czwmpc | Login";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Czwmpc | Project'; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
</head>
<body class="min-h-screen flex flex-col">
<div class="flex-grow flex items-center justify-center p-6">
    <div class="p-8 rounded-2xl w-full max-w-md">
        <div class="flex flex-row justify-center items-center gap-5">
            <a href="../index.php" class="text-sm">
                <span class="material-symbols-outlined hover:scale-75 transition-all duration-300">
                arrow_back
                </span>
            </a>
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center justify-center text-center">Welcome Back</h1>
        </div>
        
        <?php if(isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form class="flex flex-col gap-4" method="post" action="login.php">
            <div class="flex flex-col gap-1">
                <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" required class="border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all outline-none" style="padding: 5px;">
            </div>
            <div class="flex flex-col gap-1">            
                <div class="flex justify-between items-center">
                    <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                    <a href="#" class="text-xs text-green-600 hover:underline">Forgot password?</a>
                </div>
                <input type="password" name="password" id="password" required class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all outline-none" style="padding: 5px;">
            </div>

            <button type="submit" class="bg-green-600 text-white font-semibold py-5 rounded-lg hover:bg-green-700 transition-colors mt-2" style="padding: 5px;">
                Sign In
            </button>
        </form>
        <p class="text-center text-gray-600 mt-6 text-sm" style="padding: 10px;">
            Don't have an account? <a href="register.php" class="text-green-600 font-semibold hover:underline">Register here</a>
        </p>
    </div>
</div>
</body>
</html>
