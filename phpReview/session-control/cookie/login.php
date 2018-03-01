<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="js/cookie.js"></script>
</head>
<body>
<form action="doLogin.php" method="post">
    <input type="text" name="username" value=""><br>
    <input type="password" name="password" value=""><br>
    <input type="submit" name="submit" value="登录"><br>
    <label for="autologin">
        1周内自动登录
    </label>
    <input type="checkbox" id="autologin" name="autoLogin" value="1">
</form>

<script>
</script>
</body>
</html>
