<?php
include "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no = $conn->real_escape_string($_POST['no']);
    $testno = $conn->real_escape_string($_POST['testno']);
    $studentid = $conn->real_escape_string($_POST['studentid']);
    $mark = $conn->real_escape_string($_POST['mark']);

    // Check if record already exists
    $checkQuery = "SELECT * FROM mark WHERE no='$no'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Redirect to a new page with existing record details
        header("Location: existing_mark.php?no=$no");
        exit();
    } else {
        // Insert new data if no duplicate found
        $sql = "INSERT INTO mark (no, testno, studentid, mark) VALUES ('$no', '$testno', '$studentid', '$mark')";

        if ($conn->query($sql) === TRUE) {
            header("Location: Manage_mark.php?msg=New record created successfully");
            exit();
        } else {
            echo "<h3 style='color:red; text-align:center;'>Error: " . $conn->error . "</h3>";
        }
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Manu</title>
    

    <style>

        *{
           font-size: 17px;
        }

        body{
            background: rgb(234, 243, 243);
            background-size:cover;
            background-position: auto;
        }
        header{
            
            
            padding: 15px;
            background: rgb(234, 243, 243);
            border: 2px solid rgb(255,255,255,.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgb(0,0,0,.2);
            
        }
        
        
        
        .nav {
            
            float: left;
            background: rgb(234, 243, 243);
           
            width: 15%;
            margin-top: 2px;
            height: 82vh;
            padding: 20px;
            top: 0;
            left: 0;
            border: 2px solid rgb(255, 255, 255,.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .nav table {
            width: 100%;
            border-collapse: collapse;
        }
        .nav td {
            padding: 10px;
            color: rgb(0, 0, 0);
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .nav td img {
            width: 25px;
            height: 25px;
            margin-right: 10px;
        }
        .nav td i {
            margin-right: 10px;
        }
        .nav tr:hover, .submenu tr:hover {
            border: 2px solid rgb(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgb(0, 0, 0, .2);
            border-radius: 10px;
        }
        .submenu {
            display: none;
            
        }
        .submenu td {
            padding-left: 30px;
        }

        .section{
            margin-left: 230px;
        }

        .content{
            margin-top: 2px;
            
            background: rgb(234, 243, 243);
            border: 1px solid rgb(255,255,255,.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgb(0,0,0,.2);
            border-radius: 5px;
            margin-left: 20px;
        }
        .main{
            
            font-size: 20px;
            
            margin-left: 30px;
            
        }
        
        .content1{
            width:40%;
            margin: auto;
            margin-top: 10px;
            background: rgb(234, 243, 243);
            border: 1px solid rgb(255,255,255,.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgb(0,0,0,.2);
            border-radius: 5px;
            padding:10px 70px ;
            
        }

        input{
            width:100%;
        }
        </style>

</head>
<body >
    <header>
        <label class="admin">AD001|Admin</label>
        <img alt="admin" src="icons/3917688.png" width="20px" height="15px" style="margin-left:20px;">
        <img alt="logout" src="icons/4043198.png" width="15px"height="15px" style="margin-left: 80%;"><a href="Login_Page.php" style="margin-left: 10px;">Logout</a>
        
    </header>
    
    <div class="nav">
        <table>
            <tr><td ><img src="icons/3917762.png" alt="Main Menu" ><a href="Admin_Page.php" style="text-decoration: none;color: black;"> Main Menu</a></td></tr>
            <tr onclick="toggleMenu('accountMenu')"><td><img src="icons/3914283.png" alt="Account"> Student</td></tr>
            <tbody id="accountMenu" class="submenu">
                <tr><td ><i class="fas fa-user-plus"></i><a href="Add_Account.php" style="text-decoration: none;color: black;"> Add Student</a></td></tr>
                <tr><td ><i class="fas fa-users-cog"></i><a href="Manage_Account.php" style="text-decoration: none;color: black;"> Manage Students</a></td></tr>
            </tbody>
            <tr onclick="toggleMenu('examMenu')"><td><img src="icons/3914904.png" alt="Exam"> Test</td></tr>
            <tbody id="examMenu" class="submenu">
                <tr><td><i class="fas fa-file-alt"></i><a href="Add_Test.php" style="text-decoration: none;color: black;">Add Test</a> </td></tr>
                <tr><td><i class="fas fa-tasks"></i><a href="Manage_Test.php" style="text-decoration: none;color: black;"> Manage Test</a></td></tr>
            </tbody>
            <tr onclick="toggleMenu('markMenu')"><td><img src="icons/10469275.png" alt="Mark"> Mark</td></tr>
            <tbody id="markMenu" class="submenu">
                <tr><td><i class="fas fa-plus"></i><a href="Add_Mark.php" style="text-decoration: none;color: black;"> Add Mark</a></td></tr>
                <tr><td><i class="fas fa-list"></i><a href="Manage_Mark.php" style="text-decoration: none;color: black;">Manage Mark</a> </td></tr>
            </tbody>
        </table>
        
    </div>
    
    <div class="section">
        <div class="content">
            <p class="main">Add Mark</p>
            
            <hr>
            <p style="margin-left: 30px;font-size: 15px;">Home / Mark/ Add Mark</p>

        </div>
        <div class="content1">
            <form action="" method="post">
                <p>No</p>
                <input type="number" name="no" required>
                <p>Test No</p>
                <input type="number" name="testno" maxlength="5" oninput="validateNumber(this)" required>
                <p>Sudent Id</p>
                <input type="text" name="studentid"maxlength="5" id="uppercase" oninput="validateUppercase(this)" required>
                <p>Mark</p>
                <input type="number" name="mark" maxlength="3" required>
                <p></p>
                <button type="submit" name="sumbit">Save</button><a href="Manage_mark.php"></a>
            </form>
        </div>
        
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
    
        function validateUppercase(input){
            input.value=input.value.toUpperCase().replace(/[^A-Z](0-9)/g,'')
        }
        function validateNumber(input) {
            input.value = input.value.replace(/\D/g, '').slice(0, 10);
        }
        
        
    </script>
</body>
</html>