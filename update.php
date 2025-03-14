<?php
include "db_conn.php";

// Check if testno is provided
if (isset($_GET['testno']) && !empty($_GET['testno'])) {
    $testno = $conn->real_escape_string($_GET['testno']);
    
    // Fetch test details
    $result = $conn->query("SELECT * FROM test WHERE testno='$testno'");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<h3 style='color:red; text-align:center;'>No record found!</h3>";
        exit();
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $batchid = $conn->real_escape_string($_POST['batchid']);
    $testno = $conn->real_escape_string($_POST['testno']);
    $topic = $conn->real_escape_string($_POST['topic']);
    $date = $conn->real_escape_string($_POST['date']);

    $sql = "UPDATE test SET batchid='$batchid', topic='$topic', date='$date' WHERE testno='$testno'";

    if ($conn->query($sql) === TRUE) {
        echo "<h1 style='text-align:center;margin-top:30px;color:green;'>Record updated successfully.</h1>";
        echo "<script>setTimeout(function(){ window.location.href = 'Manage_Test.php'; }, 2000);</script>";
        exit();
    } else {
        echo "<h3 style='color:red; text-align:center;'>Error: " . $conn->error . "</h3>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Test</title>
    <style>
        .content1 {
            margin: auto;
            width: 40%;
            margin-top: 50px;
            background: rgb(234, 243, 243);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            padding: 20px;
            font-size: 20px;
            
        }
        input {
            width: 100%;
            font-size: 15px;
            padding: 8px;
            margin-bottom: 10px;
        }
        button {
            font-size: 15px;
            padding: 8px 15px;
            background: green;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: darkgreen;
        }
        a {
            margin-left: 20px;
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="content1">
    <form action="" method="post">
        <p>Batch ID</p>
        <input type="number" name="batchid" maxlength="5" value="<?= htmlspecialchars($row['batchid']) ?>" required>
        
        <input type="hidden" name="testno" value="<?= htmlspecialchars($row['testno']) ?>">
        
        <p>Topic</p>
        <input type="text" name="topic" value="<?= htmlspecialchars($row['topic']) ?>" required>
        
        <p>Date</p>
        <input type="date" name="date" value="<?= htmlspecialchars($row['date']) ?>" required>
        
        <p></p>
        <button type="submit" name="submit">Update</button>
        <a href="Manage_Test.php">Back</a>
    </form>
</div>
</body>
</html>
