<?php
include "db_conn.php";

if (isset($_GET['no'])) {
    $no = $conn->real_escape_string($_GET['no']);

    // Fetch existing record
    $query = "SELECT * FROM mark WHERE no='$no'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Existing Record</title>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
                .container { width: 50%; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
                h2 { color: blue; }
                p { font-size: 18px; }
                a { text-decoration: none; color: white; background-color: green; padding: 10px 20px; border-radius: 5px; }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Record Already Exists</h2>
                <p><strong>No:</strong> <?php echo $row['no']; ?></p>
                
                <br>
                <a href="Add_Mark.php">Go Back</a>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<h3 style='color:red;'>No record found!</h3>";
    }
} else {
    echo "<h3 style='color:red;'>Invalid request!</h3>";
}

$conn->close();
?>
