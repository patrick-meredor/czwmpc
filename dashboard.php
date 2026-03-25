<?php 
session_start();
require_once 'app/includes/db.php'; 

if(!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$pageTitle = "Czwmpc | Dashboard";
include 'app/partials/header.php'; 
include 'app/partials/navbar.php'; 
?>

<main class="container mx-auto p-10">
    <div class="bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-3xl font-bold mb-4">Dashboard</h2>
        <p class="text-gray-700">Welcome back, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>!</p>
        
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-blue-50 rounded-lg border border-blue-100">
                <h3 class="font-bold text-blue-800">Your Activity</h3>
                <p class="text-sm text-blue-600">View your recent contributions and status.</p>
            </div>
            <div class="p-6 bg-green-50 rounded-lg border border-green-100">
                <h3 class="font-bold text-green-800">Member Benefits</h3>
                <p class="text-sm text-green-600">Explore the perks of being a member.</p>
            </div>
            <div class="p-6 bg-purple-50 rounded-lg border border-purple-100">
                <h3 class="font-bold text-purple-800">Settings</h3>
                <p class="text-sm text-purple-600">Manage your account preferences.</p>
            </div>
        </div>
    </div>
</main>

<?php include 'app/partials/footer.php'; ?>
