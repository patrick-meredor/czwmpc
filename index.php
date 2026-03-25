<?php 
session_start();
require_once 'app/includes/db.php'; 

$pageTitle = "Czwmpc | Welcome";
include 'app/partials/header.php'; 
include 'app/partials/navbar.php'; 
?>

<main class="container mx-auto p-10 text-center">
    <h2 class="text-4xl font-bold mb-4">Welcome to Cavite Zone Workers Multipurpose Cooperation</h2>
    <p class="text-gray-600 text-lg">Your trusted partner in worker welfare and cooperation.</p>
</main>

<?php include 'app/partials/footer.php'; ?>