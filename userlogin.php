<?php
session_start();
include("db.php");

$message = "";
$message_type = "";

/* Show message only once */
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    $message_type = $_SESSION["message_type"];

    unset($_SESSION["message"]);
    unset($_SESSION["message_type"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* Sign up */
    if (isset($_POST["signup"])) {
        $name = trim($_POST["signup_name"]);
        $email = trim($_POST["signup_email"]);
        $address = trim($_POST["signup_address"]);
        $password = $_POST["signup_password"];
        $confirm_password = $_POST["signup_confirm_password"];

        if (empty($name)||empty($email) || empty($address) || empty($password) || empty($confirm_password)) {
            $_SESSION["message"] = "Please fill in all signup fields.";
            $_SESSION["message_type"] = "error";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["message"] = "Please enter a valid email address.";
            $_SESSION["message_type"] = "error";
        } elseif ($password !== $confirm_password) {
            $_SESSION["message"] = "Passwords do not match.";
            $_SESSION["message_type"] = "error";
        } else {
            $check_sql = "SELECT user_id FROM users WHERE email = ?";
            $stmt = $conn->prepare($check_sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $_SESSION["message"] = "This email is already registered.";
                $_SESSION["message_type"] = "error";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                

                $insert_sql = "INSERT INTO users (name, email, address, password) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_sql);
                $stmt->bind_param("ssss", $name, $email, $address, $hashed_password);

                if ($stmt->execute()) {
                    $_SESSION["message"] = "Signup successful. You can now sign in.";
                    $_SESSION["message_type"] = "success";
                } else {
                    $_SESSION["message"] = "Something went wrong during signup.";
                    $_SESSION["message_type"] = "error";
                }
            }
        }

        header("Location: login.php");
        exit();
    }

    /* Sign in */
    if (isset($_POST["signin"])) {
        $email = trim($_POST["signin_email"]);
        $password = $_POST["signin_password"];

        if (empty($email) || empty($password)) {
            $_SESSION["message"] = "Please fill in all signin fields.";
            $_SESSION["message_type"] = "error";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["message"] = "Please enter a valid email address.";
            $_SESSION["message_type"] = "error";
        } else {
            $sql = "SELECT user_id, name, email, password FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user["password"])) {
                    $_SESSION["user_id"] = $user["user_id"];
                    $_SESSION["user_name"] = $user["name"];
                    $_SESSION["user_email"] = $user["email"];

                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION["message"] = "Incorrect password.";
                    $_SESSION["message_type"] = "error";
                }
            } else {
                $_SESSION["message"] = "No account found with that email.";
                $_SESSION["message_type"] = "error";
            }
        }

        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flood Relief Management System - Login</title>
</head>
<body>
    <?php if (!empty($message)): ?>
        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div id="background">
        <div class="background-Right"></div>
        <div class="background-Left"></div>
    </div>

    <div id="slide">
        <div class="top">
            <div class="left">
                <div class="content">
                    <h2>Sign Up</h2>
                    <form method="post" action=""novalidate>
                        <input type="text" name="signup_name" placeholder="Full Name" required>
                        <input type="text" name="signup_email" placeholder="Email" required>
                        <input type="text" name="signup_address" placeholder="Address" required>
                        <input type="password" name="signup_password" placeholder="Password" required>
                        <input type="password" name="signup_confirm_password" placeholder="Confirm Password" required>
                        <button type="submit" name="signup">Sign up</button>
                    </form>
                    <p>Already have an account?
                        <a href="#" id="RighttoLeft" class="on-off">Sign in</a>
                    </p>
                </div>
            </div>

            <div class="right" id="rightBox">
                <div class="content">
                    <h2>Sign in</h2>
                     <form method="post" action=""novalidate>
                       <form method="post" action="">
                       <input type="text" name="signin_email" placeholder="Email" required>
                       <input type="password" name="signin_password" placeholder="Password" required>
                       <button type="submit" name="signin">Sign in</button>
                    </form>
                    
                    <p>Don't have an account?
                        <a href="#" id="LefttoRight" class="on-off">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
<style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        html, body{
            width:100%;
            height:100%;
            overflow:hidden;
        }

        body{
            position:relative;
        }

        #background{
            width:100%;
            height:100%;
            position:absolute;
            inset:0;
            z-index:-1;
        }

        .background-Right{
            position:absolute;
            right:0;
            width:50%;
            height:100%;
            background:linear-gradient(to right, #000428, #004e92);
        }

        .background-Left{
            position:absolute;
            left:0;
            width:50%;
            height:100%;
            background:linear-gradient(to right, #0a0b0b, #004e92);
        }

        #slide{
            width:50%;
            height:100%;
            overflow:hidden;
            position:absolute;
            top:0;
            left:50%;
            background:#fff;
            box-shadow:0 14px 28px rgba(0,0,0,0.25),
                       0 10px 10px rgba(0,0,0,0.22);
            transition:left 0.6s ease;
        }

        .top{
            width:200%;
            height:100%;
            display:flex;
            transform:translateX(0);
            transition:transform 0.6s ease;
        }

        .left,
        .right{
            width:50%;
            height:100%;
            position:relative;
            background:#fff;
        }

        .content{
            width:280px;
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%, -50%);
        }

        .content h2{
            color:#004e92;
            font-size:35px;
            margin-bottom:20px;
            text-align:center;
        }

        input[type="text"],
        input[type="password"]{
            width:100%;
            padding:12px 16px;
            margin:8px 0;
            border:1px solid #004e92;
            outline:none;
        }

        button{
            background-color:#004e92;
            color:white;
            border-radius:6px;
            width:100%;
            padding:14px 20px;
            margin:12px 0;
            border:none;
            cursor:pointer;
        }

        p{
            margin-top:10px;
            text-align:center;
            font-size:14px;
        }

        .on-off{
            color:#004e92;
            text-decoration:none;
            font-weight:bold;
            cursor:pointer;
        }

        .message{
            width: 90%;
            max-width: 420px;
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 12px 16px;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
            z-index: 20;
        }

        .success{
            background: #d4edda;
            color: #155724;
        }

        .error{
            background: #f8d7da;
            color: #721c24;
        }

        .back-home{
            position:absolute;
            top:20px;
            left:20px;
            color:white;
            text-decoration:none;
            font-weight:bold;
            z-index:10;
            border:1px solid white;
            padding:10px 16px;
            border-radius:6px;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const slide = document.getElementById("slide");
            const topBox = document.querySelector(".top");

            document.getElementById("RighttoLeft").addEventListener("click", function (e) {
                e.preventDefault();
                slide.style.left = "0";
                topBox.style.transform = "translateX(-50%)";
            });

            document.getElementById("LefttoRight").addEventListener("click", function (e) {
                e.preventDefault();
                slide.style.left = "50%";
                topBox.style.transform = "translateX(0)";
            });

         setTimeout(() => {
                const msg = document.querySelector(".message");
                if(msg){
                    msg.style.opacity = "0";
                    setTimeout(() => {
                        msg.style.display = "none";
                    }, 500);
                }
            }, 3000);
        });
    </script>

</body>
</html>