<?php declare(strict_types = 1); ?>

<?php function drawHeader() { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>The Spoon</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <header>
      <h1><a href="/">The Spoon</a></h1>
      <h5><a href="/">Where you can eat until you roll!</a></h5>
      <img src="images/dog.jpg" alt ="a dog" width="300" height="200">
      <?php 
        if (isset($_SESSION['id'])) drawLogoutForm($_SESSION['name']);
        else drawLogin();
      ?>
    </header>
  
    <main>
<?php } ?>

<?php function drawFooter() { ?>
    </main>

    <footer>
      The Spoon &copy; 2022
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawLogin() { ?>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
<?php } ?>

<?php function drawLogInForm() { ?>
  <form action="action_login.php" method="post" class="login">
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Email" name="email" id="email" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>

    <button type="submit">Login</button>
  </form>
<?php } ?>

<?php function drawLogoutForm(string $name) { ?>
  <form action="action_logout.php" method="post" class="logout">
    <a href="profile.php"><?=$name?></a>
    <button type="submit">Logout</button>
  </form>
<?php } ?>

<?php function drawRegisterForm() { ?>
  <form action="action_register.php" method="post" class="register">
    <div>
      <h1>Create your account</h1>
      <hr>

      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Username" name="username" id="username" required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Email" name="email" id="email" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" id="password" required>

      <label for="password-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="password-repeat" id="password-repeat" required>

      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Name" name="name" id="name" required>
      
      <label for="phone"><b>Phone Nr</b></label>
      <input type="tel" placeholder="Phone Number" name="phone" id="phone" pattern="[0-9]{9}" required>

      <label for="state"><b>State</b></label>
      <input type="text" placeholder="State" name="state" id="state" required>
      
      <label for="city"><b>City</b></label>
      <input type="text" placeholder="City" name="city" id="city" required>

      <label for="street"><b>Street</b></label>
      <input type="text" placeholder="Street" name="street" id="street" required>

      <label for="postal-code"><b>Postal Code</b></label>
      <input type="text" placeholder="Postal Code" name="postal-code" id="postal-code" required>
      
      <button type="submit">Submit</button>
    </div>
  </form>
<?php } ?>

<?php function drawRegisterFormRestaurant() { ?>
  <form action="action_register_restaraunt.php" method="post" class="registerRestaraunt">

  </form>
<?php } ?>
