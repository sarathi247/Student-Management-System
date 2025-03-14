<?php
include "db_conn.php";

// Check if testno is provided
if (isset($_GET['userid']) && !empty($_GET['userid'])) {
    $userid = $conn->real_escape_string($_GET['userid']);
    
    // Fetch test details
    $result = $conn->query("SELECT * FROM student WHERE userid='$userid'");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<h3 style='color:red; text-align:center;'>No record found!</h3>";
        exit();
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $email = $conn->real_escape_string($_POST['email']);
    $phonenumber = $conn->real_escape_string($_POST['phonenumber']);
    $address = $conn->real_escape_string($_POST['address']);
    $batchid = $conn->real_escape_string($_POST['batchid']);
    $coursename = $conn->real_escape_string($_POST['coursename']);
    $sjd = $conn->real_escape_string($_POST['sjd']);
    $userid = $conn->real_escape_string($_POST['userid']);

    $sql = "UPDATE student SET name='$name', dob='$dob', gender='$gender',email='$email',phonenumber='$phonenumber',address='$address',batchid='$batchid',coursename='$coursename',sjd='$sjd' WHERE userid='$userid'";

    if ($conn->query($sql) === TRUE) {
        echo "<h1 style='text-align:center;margin-top:30px;color:green;'>Record updated successfully.</h1>";
        echo "<script>setTimeout(function(){ window.location.href = 'Manage_Account.php'; }, 2000);</script>";
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
        
                <p>Name</p>
                <input type="text" name="name"value="<?= htmlspecialchars($row['name']) ?>" required>
                <p>DOB</p>
                <input type="date" name="dob" value="<?= htmlspecialchars($row['dob']) ?>"required>
                <p>Gender:<input type="checkbox" style="width: 20px;"name="gender" value="male" value="<?= htmlspecialchars($row['gender']) ?>" onclick="checkOnlyOne(this)">Male<input type="checkbox"style="width: 20px;"name="gender" value="male"value="<?= htmlspecialchars($row['gender']) ?>" onclick="checkOnlyOne(this)">Female</p>
                <p>Email Id</p>
                <input type="email" name="email"value="<?= htmlspecialchars($row['email']) ?>" required>
                <p>Phone Number</p>
                <input type="number" name="phonenumber" maxlength="10" value="<?= htmlspecialchars($row['phonenumber']) ?>" oninput="validateNumber(this)" required>
                <P>Address</P>
                <input type="text" name="address"value="<?= htmlspecialchars($row['address']) ?>" required>
                <p>Batch Id</p>
                <input list="details" name="batchid"value="<?= htmlspecialchars($row['batchid']) ?>" class="input3"maxlength="1" required >
                <datalist id="details">
                    <option value="1"></option>
                    <option value="2"></option>
                    <option value="3"></option>
                    <option value="4"></option>
                </datalist>
                <p class="ut">Course Name</p>
                <input list="details1" name="coursename"value="<?= htmlspecialchars($row['coursename']) ?>" class="input34"required >
                <datalist id="details1">
                    <option value="Java Full Stack"></option>
                    <option value="Python Full Stack"></option>
                    <option value="Mern Full Stack"></option>
                </datalist>
                <p>Student join date</p>
                <input type="date" name="sjd" value="<?= htmlspecialchars($row['sjd']) ?>" required>
                
                <input type="hidden" value="<?= htmlspecialchars($row['userid']) ?>"name="userid" maxlength="5" id="uppercase" oninput="validateUppercase(this)"required>
        <p></p>
        <button type="submit" name="submit">Update</button>
        <a href="Manage_Account.php">Back</a>
    </form>
</div>

<script>
        function toggleMenu(menuId) {
            var menu = document.getElementById(menuId);
            if (menu.style.display === "table-row-group") {
                menu.style.display = "none";
            } else {
                menu.style.display = "table-row-group";
            }
        }

        const pathName=window.location.pathname;
        const pageName=pageName.split("/").pop();
        if(pageName === "Add_Account.php"){
            document.querySelector(".add_acc");
        }
        
    </script>
</body>
</html>
