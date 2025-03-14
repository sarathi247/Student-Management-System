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
            display: flex;
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

        .manage{
            width:80%;
            margin: auto;
            margin-top: 10px;
            background: rgb(234, 243, 243);
            border: 1px solid rgb(255,255,255,.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgb(0,0,0,.2);
            border-radius: 5px;
            padding:20px 50px ;
            
        }
        .back{
            background: rgb(234, 243, 243);
            border: 1px solid rgb(255,255,255,.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgb(0,0,0,.2);
            border-radius: 5px;
            padding:10px;
            margin-right:785px;
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
            <tr onclick="toggleMenu('accountMenu')"><td><img src="icons/3914283.png" alt="Account"> Account</td></tr>
            <tbody id="accountMenu" class="submenu">
                <tr><td ><i class="fas fa-user-plus"></i><a href="Add_Account.php" style="text-decoration: none;color: black;"> Add Students</a></td></tr>
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
        <p class="main">Manage Students</p>
    </div>

    <div class="manage">
     

        <!-- Search Form -->
        <form method="GET">
            <input type="text" name="search" class="search-bar" placeholder="Search by User ID" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="search-btn">Search</button>
        </form>

        <?php
        include "db_conn.php";

        // Search functionality
        $searchQuery = "";
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $conn->real_escape_string($_GET['search']);
            $searchQuery = " WHERE userid LIKE '%$search%'";
        }

        // Fetching records from the database
        $sql = "SELECT * FROM student" . $searchQuery;
        $result = $conn->query($sql);

        echo "<br/><div class='back'><a href='Add_Account.php'>Add Student</a></div><br/>";

        if ($result->num_rows > 0) {
            echo "<table border='1' style='width:100%; text-align:center; font-size:18px; border-collapse: collapse;'>
                    <tr>
                        <th>User ID</th><th>Name</th><th>Date Of Birth</th><th>Gender</th><th>Email</th><th>Phone Number</th><th>Address</th><th>Course Name</th><th>Action</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['userid']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phonenumber']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['coursename']}</td>
                        <td>
                            <a class='edit' href='Add_update.php?userid={$row['userid']}'>Edit</a> |
                            <a class='delete' href='Account_delete.php?userid={$row['userid']}'>Delete</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color: red;'>No records found.</p>";
        }

        $conn->close();
        ?>
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
        
    </script>
</body>
</html>