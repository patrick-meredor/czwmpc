<?php 
session_start();
require_once 'app/includes/db.php'; 

$pageTitle = "Czwmpc | Welcome";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Czwmpc | Project'; ?></title>
    <link rel="stylesheet" href="/czwmpc_project/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<main class="w-full h-screen flex flex-col items-center justify-center text-center px-4 py-16">
    <div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-1000">
        <div class="space-y-4">
            <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 leading-tight">
                Welcome to <span class="bg-gradient-to-r from-green-400 to-green-700 bg-clip-text text-transparent">Cavite Zone Workers</span> <br class="hidden md:inline"> Multipurpose Cooperation
            </h2>
            <p class="text-gray-600 text-xl mx-auto leading-relaxed">
                Empowering workers through cooperation, financial growth, and dedicated support for a sustainable future.
            </p>
        </div>

        <div class="flex flex-row items-center justify-center gap-4 pt-4">
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="./auth/register.php" class="bg-green-700 text-white font-semibold rounded-xl" style="padding: 10px;">
                    Join Our Cooperation
                </a>
                <a href="./auth/login.php" class="text-gray-700 font-semibold rounded-xl" style="padding: 10px;">
                    Sign In
                </a>
            <?php else: ?>
                <a href="./dashboard.php" class="bg-green-700 text-white font-semibold rounded-xl" style="padding: 5px;">
                    Go to Dashboard
                </a>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>

<?php include 'app/partials/footer.php'; ?>