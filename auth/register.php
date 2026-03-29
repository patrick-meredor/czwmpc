<?php 
session_start();
require_once ('../app/includes/db.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    
    if($stmt->execute()) {
        header("Location: login.php?registered=1");
        exit();
    } else {
        $error = "Registration failed. Email might already be in use.";
    }
}

$pageTitle = "Czwmpc | Register";
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
    <div class="p-8 md:p-10 rounded-2xl w-full max-w-md">
        <div class="flex flex-row justify-center items-center gap-5">
            <a href="../index.php" class="text-sm">
                <span class="material-symbols-outlined hover:scale-75 transition-all duration-300">
                arrow_back
                </span>
            </a>
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center justify-center text-center">Create Account</h1>
        </div>
        
        <?php if(isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form class="flex flex-col gap-4" method="post" action="register.php">
            <div class="flex flex-col gap-1">
                <label for="name" class="text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="name" required class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all outline-none" style="padding: 5px;">
            </div>
            <div class="flex flex-col gap-1">
                <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" required class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all outline-none" style="padding: 5px;">
            </div>
            <div class="flex flex-col gap-1">
                <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all outline-none" style="padding: 5px;">
            </div>

            <button type="submit" class="bg-green-600 text-white font-semibold py-5 rounded-lg hover:bg-green-700 transition-colors mt-2" style="padding: 5px;">
                Register
            </button>
        </form>
        <p class="text-center text-gray-600 mt-6 text-sm" style="padding: 10px;">
            Already have an account? <a href="login.php" class="text-green-600 font-semibold hover:underline">Sign in here</a>
        </p>
    </div>
</div>
</body>
</html>
