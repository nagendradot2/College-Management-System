
<?php
session_start();
$con = mysqli_connect("db", "root", "root", "cms");

if (isset($_POST["submit"])) {
    $username = $_POST["user"];
    $password = $_POST["pass"];

    $query = "SELECT * FROM login WHERE id='$username' AND pass='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            if ($row["type"] == "admin") {
                $_SESSION['LoginAdmin'] = $row["id"];
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.location.href = 'admin_dash.php';</script>";
                exit();
            } else if ($row["type"] == "staff") {
                $_SESSION['LoginStaff'] = $row["id"];
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.location.href = 'staff_dsh.php';</script>";
                exit();
            } else if ($row["type"] == "student") {
                $_SESSION['LoginStudent'] = $row['id'];
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.location.href = 'student_dash.php';</script>";
                exit();
            }
        }
    } else {
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}
?>

 <!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: url("starting.png");
            background-size: cover;
            height: 100vh;
        }

        .login-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #ff3333;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .login-popup {
            width: 320px;
            height: auto;
            background: #1a1a1a;
            color: #fff;
            padding: 40px 30px;
            border-radius: 20px;
            position: relative;
        }

        .close-button {
            position: absolute;
            top: 26px;
            right: 25px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }

        h2 {
            margin: 0 0 20px;
            text-align: center;
            font-size: 22px;
        }

        .user-box {
            position: relative;
            margin-bottom: 30px;
        }

        .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            background: transparent;
        }

        .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            pointer-events: none;
            transition: 0.5s;
        }

        .user-box input:focus ~ label,
        .user-box input:valid ~ label {
            top: -20px;
            left: 0;
            color: #ffc107;
            font-size: 12px;
        }

        input[type="submit"] {
            background: green;
            transition: 0.5s;
            width: 100%;
            height: 40px;
            border-radius: 10px;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, white);
        }

        input[type="submit"]:hover {
            background: skyblue;
            color: #000;
        }
       
    </style>
</head>
<body>
    <button class="login-button" onclick="openLoginPopup()">Login</button>

    <div class="overlay" id="overlay">
        <div class="login-popup">
            <span class="close-button" onclick="closeLoginPopup()">&times;</span>
            <h2>Login</h2>
            <form action="index.php" method="POST">
                <div class="user-box">
                    <input type="text" name="user" autocomplete="off"  required>
                    <label>Username</label>
                </div>
                <div class="user-box">
                    <input type="password" name="pass" autocomplete="off" required>
                    <label>Password</label>
                </div>
                <input type="submit"  name="submit" value="Submit">
            </form>
        </div>
    </div>

    <script>
        function openLoginPopup() {
            var overlay = document.getElementById("overlay");
            overlay.style.display = "flex";
        }

        function closeLoginPopup() {
            var overlay = document.getElementById("overlay");
            overlay.style.display = "none";
        }
    </script>
</body>
</html> 

