<?php
include "db_conn.php";

if (isset($_GET['userid']) && !empty($_GET['userid'])) {
    // Sanitize input
    $userid = $conn->real_escape_string($_GET['userid']);

    // Delete query
    $sql = "DELETE FROM student WHERE userid = '$userid'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request. User ID not found.";
}

$conn->close();

// Redirect after deletion
header("Location: Manage_Account.php");
exit();
?>
