<nav class="flex flex-row justify-between items-center mx-auto p-5 ">
    <h1 class="font-bold text-2xl">
        <a href="./index.php">Cavite Zone Workers Multipurpose Cooperation</a>
    </h1>

    <div class="flex flex-row justify-center items-center gap-3">
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="./dashboard.php" class="px-2 py-2 rounded">Dashboard</a>
            <a href="./auth/logout.php" class="px-2 py-2 rounded border">Logout</a>
        <?php else: ?>
            <a href="./auth/login.php" class="border px-2 py-2 rounded">Login</a>
            <a href="./auth/register.php" class="px-2 py-2 rounded bg-green-500 text-black hover:border-green-300 hover:text-white transition-all duration-300">
                Register
            </a>
        <?php endif; ?>
    </div>
</nav>
