<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>

        
        .login{
            margin:auto;
            /* background-color: aqua; */
            margin-top: 60px;
            height:450px;
            width:60% ;
            display:flex;
            padding:20px;
            
            
        }
        .user{
            width: 40%;
            background:url(download.jpg) no-repeat;
            background-size: cover;
            background-position: auto;
            justify-content:center;
            align-items: center;
      
            /* background-color: blueviolet; */
        }
        .userlogin{
            width: 60%;
            background: transparent;
            border: 2px solid rgb(255,255,255,.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgb(0,0,0,.2);
            
            /* background-color: green; */
        }
        .input{
            margin: auto;
            width: 50%;
            height: 70%;
            /* background-color: aqua; */
        }
        .input1{
            margin-top: 10px;
            margin-bottom: 10px;
            width: 100%;
            padding: 2px;
            
        }
        .up{
            font-size: 16px;
            display: inline;
            font-weight: bold;    
        }

        .input2{
            margin-top: 10px;
            margin-bottom: 10px;
            width: 100%;
            padding: 2px;
        }
        .ui{
            font-size: 16px;
            display: inline;
            font-weight: bold;    
        }
        
        .ut{
            font-size: 16px;
            display: inline;
            font-weight: bold;    
        }

        .input3{
            margin-top: 10px;
            width: 100%;
            padding: 2px;
        }
        
       .but{
        margin-left: 182px;
        padding-right: 15px;
        padding-left: 15px;
        padding-top:3px;
        padding-bottom:3px;
       }

    </style>
        

    <script>
        function validateUppercase(input){
            input.value=input.value.toUpperCase().replace(/[^A-Z](0-9)/g,'')
        }

        
    </script>
    
    
</head>
<body>
    
    
        <div class="login">
            <div class="user">
                <h1 style="text-align: center;color: white;">Welcome User!</h1>
                
                <img src="images-removebg-preview.png" width="300px" height="300px" style="margin-left: auto;margin-right: auto;display: block;">
                
            </div>
            
            <div class="userlogin">
                <form id="UserLoginForm">
                <h1 style="text-align: center;">Student Management System</h1>
                <h1 style="text-align: center;">Login Page</h1>
                <div class="input">
                <p class="ui">User Id</p>
               <input type="text" class="input1" id="userId" maxlength="15" id="uppercase" oninput="validateUppercase(this)" required>
               <p id="rollError" class="error"></p> 
               <p class="up">Password</p>
                <input type="password" class="input2" id="password" maxlength="15" required>
                <p class="ut">User Type</p>
                
                <input list="details" class="input3" id="type" placeholder="Admin/Student" required>
                <datalist id="details">
                    <option value="Admin"></option>
                    <option value="Student"></option>
                </datalist>
                <p>
                    <a href="#">Forgot password?</a>
                </p>
                <input type="submit" value="Login" class="but">
            </form>
                </div>
            
            </div>
            
        </div>
    


    <script>
        const adminCredentials = {
            userId: "AD001",
            password: "admin@001",
            type:"Admin"
        };

        // Adding event listener to the admin login form
        document.getElementById("UserLoginForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission

            // Get input values
            const enteredUserId = document.getElementById("userId").value.trim();
            const enteredPassword = document.getElementById("password").value.trim();
            const enteredType = document.getElementById("type").value.trim();

            // it will check the userID and Password are equal to the mentioned credentials
            if (enteredUserId === adminCredentials.userId && enteredPassword === adminCredentials.password && enteredType === adminCredentials.type) {
                
                // Redirect to another page or perform other actions
                window.location.href = "Admin_Page.php"; // Replace with your dashboard page
            } else {
                alert("Invalid User ID or Password or UserType. Please try again.");
            }
        });
    </script>
</body>
</html>