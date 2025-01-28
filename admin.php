<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .login-container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #e9ecef;
        }

        .login-box {
            width: 350px;
            padding: 40px;
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .login-header {
            background-color: #4a90e2;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .login-box h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .login-box label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333333;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .login-box input[type="submit"] {
            width: 100%;
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-box input[type="submit"]:hover {
            background-color: #357abd;
        }

        .error-message {
            font-size: 12px;
            color: #cc0000;
            margin-top: 10px;
        }

    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <b>Admin Login</b>
            </div>

            <form action="adminLogin.php" method="POST">
                <h2>Welcome</h2>
                <label>UserName:</label>
                <input type="text" name="user" class="box" required />

                <label>Password:</label>
                <input type="password" name="pass" class="box" required />

                <input type="submit" value="Login" />
            </form>

            <div class="error-message">
                <?php echo isset($error) ? $error : ''; ?>
            </div>
        </div>
    </div>

</body>

</html>
