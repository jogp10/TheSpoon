<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet">
    <title>The Spoon</title>
</head>

<body>
    <header>
        <h1><a href="index.php" title="Main Page">The Spoon</a></h1>
        <a href="index.php" title="Main Page"><img src="images/dog.jpg" alt ="a dog" width="300" height="200"></a>
    </header>
    <form>
        <h3>Register</h3>
        <label>
            First Name:
            <input type="text" placeholder="First Name">
        </label>
        <label>
            Last Name:
            <input type="text" placeholder="Last Name">
        </label><br>
        <label>
            Email:
            <input type="text" placeholder="example@gmail.com">
        </label><br>
        <label>
            Password:
            <input type="password">
        </label><br>
        <label>
            Repeat Password:
            <input type="password">
        </label><br>
        <button type="submit">Register</button>
      </form>
      <p>Already have an account?<a href="login.php">Sign in</a></p>
      <footer>
        <p>Copyright &copy; Fake News, 2022</p>
      </footer>
</body>

</html>
