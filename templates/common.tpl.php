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
    <script src="javascript/script.js" defer=""></script>
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
    <footer>
      The Spoon &copy; 2022
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawLogInForm() { ?> 
  <form action="action_login.php" method="post" class="login">
    <input type="email" placeholder="Email" name="email" id="email">
    <input type="password" placeholder="Enter Password" name="password" id="password">
    <button type="submit">Login</button>

    <button><a href="register.php">Register</a></button>
  </form>
<?php } ?>

<?php function drawLogoutForm(string $name) { ?>
  <form action="action_logout.php" method="post" class="logout">
    <a href="profile.php"><?=$name?></a>
    <?php if($_SESSION['owner']) { ?>
      <button><a href="register_rest.php">Register Your Restaurant</a></button>
    <?php } ?>
    <button type="submit">Logout</button>
  </form>
<?php } ?>

<?php function drawRegisterForm() { ?>
  <form action="action_register.php" method="post" class="register">
    <h1>Create your account</h1>
    <hr>
    
    <input type="email" placeholder="Email" name="Email" id="Email" required>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>
    <input type="password" placeholder="Repeat Password" name="password-repeat" id="password-repeat" required>
    <input type="text" placeholder="Name" name="name" id="name" required>
    <input type="tel" placeholder="Phone Number" name="phone" id="phone" pattern="[0-9]{9}" required>
    <input type="text" placeholder="State" name="state" id="state" required>
    <input type="text" placeholder="City" name="city" id="city" required>
    <input type="text" placeholder="Street" name="street" id="street" required>
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


<?php function drawSearchBar() { ?>
  <div class="topnav" id="searchRestaurant">
    <input type="text" placeholder="Search..">
  </div>
<?php } ?>

<?php function drawCart() { ?>
  <div>
    <a id="cart" href="cart.php"><img src="images/cart.png" alt ="cart icon" width="30" height="30">(0<?php ?>)</a>
  </div>
<?php } ?>