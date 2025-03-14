<?php
include "db_conn.php";

if (isset($_GET['no'])) {
    $no = $_GET['no'];
    $sql = "DELETE FROM mark WHERE no=$no";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
header("Location: Manage_mark.php");
exit();
?>