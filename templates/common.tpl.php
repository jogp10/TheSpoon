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
    <link rel="stylesheet" href="css/layout.css">
    <script src="cart.js" defer=""></script>
    <script src="search.js" defer=""></script>
  </head>
  <body>

    <header>
      <a id="logo" href="index.php"><img src="images/The Spoon.png" alt ="theSpoon logo" width="300" height="200"></a>
      <?php 
        if (isset($_SESSION['id'])) drawLogoutForm($_SESSION['name']);
        else drawLogInForm();
      ?>
    </header>
  
    <main>
<?php } ?>

<?php function drawFooter() { ?>
    </main>
    <footer class="site-footer">
      <p>The Spoon &copy; 2022</p>
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawLogInForm() { ?> 
  <form action="action_register_rest.php" method="post" class="registerRest">
    <button type="submit">Register Your Restaurant</button>
  </form>
  <form action="action_login.php" method="post" class="login">
    <label for="email"><b></b></label>
    <input type="text" placeholder="Email" name="email" id="email" required>

    <label for="password"><b></b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>

    <button type="submit">Login</button>
  </form>
  <form action="register.php" method="post" class="register">
    <button type="submit" formaction="register.php">Register</button>
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
    <h1>Create your account</h1>
    <hr>

    <label for="Email"><b></b></label>
    <input type="text" placeholder="Email" name="Email" id="Email" required>

    <label for="password"><b></b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>

    <label for="password-repeat"><b></b></label>
    <input type="password" placeholder="Repeat Password" name="password-repeat" id="password-repeat" required>

    <label for="name"><b></b></label>
    <input type="text" placeholder="Name" name="name" id="name" required>
    
    <label for="phone"><b></b></label>
    <input type="tel" placeholder="Phone Number" name="phone" id="phone" pattern="[0-9]{9}" required>

    <label for="state"><b></b></label>
    <input type="text" placeholder="State" name="state" id="state" required>
    
    <label for="city"><b></b></label>
    <input type="text" placeholder="City" name="city" id="city" required>

    <label for="street"><b></b></label>
    <input type="text" placeholder="Street" name="street" id="street" required>

    <label for="postal-code"><b></b></label>
    <input type="text" placeholder="Postal Code" name="postal-code" id="postal-code" required>

    <label for="restaurant-owner" value="true"><b>Restaurant Owner</b></label>
    <input type="checkbox" name="restaurant-owner" id="restaurant-owner">

  
    <button type="submit">Submit</button>
  </form>
<?php } ?>

<?php function drawRegisterFormRestaurant() { ?>
  <form action="action_register_restaraunt.php" method="post" class="registerRestaraunt">

  </form>
<?php } ?>
