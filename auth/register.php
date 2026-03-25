<?php 
session_start();
require_once '../includes/db.php'; 

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
$bodyClass = "bg-gray-100 flex flex-col min-h-screen";
include '../app/partials/header.php'; 
include '../app/partials/navbar.php'; 
?>

<div class="flex-grow flex items-center justify-center p-5">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create Account</h1>
        
        <?php if(isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form class="flex flex-col gap-4" method="post" action="register.php">
            <div class="flex flex-col gap-1">
                <label for="name" class="text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="name" required class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
            </div>
            <div class="flex flex-col gap-1">
                <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" required class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
            </div>
            <div class="flex flex-col gap-1">
                <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
            </div>

            <button type="submit" class="bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition-colors shadow-md mt-2">
                Register
            </button>
        </form>
        <p class="text-center text-gray-600 mt-6 text-sm">
            Already have an account? <a href="login.php" class="text-blue-600 font-semibold hover:underline">Sign in here</a>
        </p>
    </div>
</div>

<?php include '../app/partials/footer.php'; ?>
