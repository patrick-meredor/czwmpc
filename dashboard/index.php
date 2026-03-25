<?php 
require_once '../config/database.php';

$sql = "SELECT id, name, email FROM users";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Czwmpc | Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Registered Users</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php
            // 4. Check if we actually got any rows back from the database
            if ($result->num_rows > 0) {
                
                // 5. Loop through each row of data
                // fetch_assoc() grabs one row at a time and turns it into an array
                while($row = $result->fetch_assoc()) {
                    
                    // 6. Display the data inside Tailwind styled HTML!
                    echo "<div class='bg-white p-6 rounded-lg shadow-md border border-gray-200'>";
                    echo "<p class='text-sm text-gray-500'>User ID: " . $row["id"] . "</p>";
                    echo "<h2 class='text-xl font-bold text-blue-600'>" . htmlspecialchars($row["name"]) . "</h2>";
                    echo "<p class='text-gray-700'>" . htmlspecialchars($row["email"]) . "</p>";
                    echo "</div>";
                }
            } else {
                // What to show if the table is empty
                echo "<p class='text-gray-500'>No users found in the database.</p>";
            }

            // 7. Close the connection when you are completely done
            $conn->close();
            ?>
        </div>
    </div>

</body>
</html>