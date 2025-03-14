
<?php
include "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting input data
    $name = trim($_POST['name']);
    $dob = trim($_POST['dob']);
    $gender = trim($_POST['gender']);
    $email = trim($_POST['email']);
    $phonenumber = trim($_POST['phonenumber']);
    $address = trim($_POST['address']);
    $batchid = trim($_POST['batchid']);
    $coursename = trim($_POST['coursename']);
    $sjd = trim($_POST['sjd']);
    $userid = trim($_POST['userid']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT); // Hashing password for security

    // Check if any required field is empty
    if (empty($name) || empty($dob) || empty($gender) || empty($email) || empty($phonenumber) || empty($address) || empty($batchid) || empty($coursename) || empty($sjd) || empty($userid) || empty($_POST['password'])) {
        echo "Error: All fields are required!";
        exit();
    }

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO student (name, dob, gender, email, phonenumber, address, batchid, coursename, sjd, userid, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssssss", $name, $dob, $gender, $email, $phonenumber, $address, $batchid, $coursename, $sjd, $userid, $password);

        if ($stmt->execute()) {
            header("Location: Manage_Account.php?msg=New record created successfully");
            exit();
        } else {
            echo "Failed: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error in SQL preparation: " . $conn->error;
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
            <p class="main">Add Student </p>
            
            <hr>
            <p style="margin-left: 30px;font-size: 15px;">Home / Student/ Add Student</p>

        </div>
        <div class="content1">
            <form action="" method="post">
                
                <p>Name</p>
                <input type="text" name="name" required>
                <p>DOB</p>
                <input type="date" name="dob"required>
                <p>Gender:<input type="checkbox" style="width: 20px;"name="gender" value="male" onclick="checkOnlyOne(this)">Male<input type="checkbox"style="width: 20px;"name="gender" value="male" onclick="checkOnlyOne(this)">Female</p>
                <p>Email Id</p>
                <input type="email" name="email" required>
                <p>Phone Number</p>
                <input type="number" name="phonenumber" maxlength="10" oninput="validateNumber(this)" required>
                <P>Address</P>
                <input type="text" name="address" required>
                <p>Batch Id</p>
                <input list="details" name="batchid" class="input3"maxlength="1" required >
                <datalist id="details">
                    <option value="1"></option>
                    <option value="2"></option>
                    <option value="3"></option>
                    <option value="4"></option>
                </datalist>
                <p class="ut">Course Name</p>
                <input list="details1" name="coursename" class="input34"required >
                <datalist id="details1">
                    <option value="Java Full Stack"></option>
                    <option value="Python Full Stack"></option>
                    <option value="Mern Full Stack"></option>
                </datalist>
                <p>Student join date</p>
                <input type="date" name="sjd" required>
                <p>User Id</p>
                <input type="text" name="userid" maxlength="5" id="uppercase" oninput="validateUppercase(this)"required>
                <p>Password</p>
                <input type="text" name="password"required>
                <!-- <p>User Image</p>
                <input type="image" name="image"> -->
                <button type="submit" name="sumbit" style="margin-top:15px;">Save</button><a href="Manage_Account.php"></a>
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
        function checkOnlyOne(clickedCheckbox) {
            let checkboxes = document.getElementsByName('gender');
            checkboxes.forEach((checkbox) => {
                if (checkbox !== clickedCheckbox) {
                    checkbox.checked = false;
                }
            });
        }
        function validateNumber(input) {
            input.value = input.value.replace(/\D/g, '').slice(0, 10);
        }
    </script>
</body>
</html>