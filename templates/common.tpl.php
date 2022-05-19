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
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="javascript/search.js" defer=""></script>
    <script src="javascript/header.js" defer=""></script>
    <script src="javascript/cart.js" defer=""></script>
  </head>
  <body>

    <header id="header">
      <a id="logo" href=""><img src="images/The Spoon.png" alt ="theSpoon logo" width="300" height="200"></a>
      <?php 
        if (isset($_SESSION['id'])) drawLogoutForm($_SESSION['name']);
        else drawLogInForm();
      ?>
    </header>
  
    <main class="content">
<?php } ?>

<?php function drawFooter() { ?>
    </main>
    <footer class="footer">
      The Spoon &copy; 2022
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawLogInForm() { ?> 
  <button type="button" class="open-button" id="logInButton" onclick="openLogInForm()">Login</button>
  <div class="form-popup" id="loginForm">
    <form action="action_login.php" method="post" class="form-container">
      <h1>Login</h1>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" id="email" required>
      
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" id="password" required>
      
      <p>Don't have an account? No problem, <a onclick="closeLogInForm(); openRegisterForm()" class="registerLink">register.</a></p>

      <button type="submit" class="btn">Login</button>
      <button type="button" class="btn cancel" onclick="closeLogInForm()">Close</button>
    </form>
  </div>
  <?=drawRegisterForm();?>
<?php } ?>

<?php function drawLogoutForm(string $name) { ?>
  <form action="action_logout.php" method="post" class="logout">
    <div class="userName">
      <a href="profile.php"><?=$name?></a>
      <button type="submit">Logout</button>
      <?php if($_SESSION['owner']) { ?>
        <button id="restRegister"><a href="register_rest.php">Register Your Restaurant</a></button>
      <?php } ?>
    </div>
  </form>
<?php } ?>

<?php function drawRegisterForm() { ?>
  <button type="button" class="open-button" id="registerButton" onclick="openRegisterForm()">Register</button>
  <div class="form-popup-reg" id="registerForm">
    <form action="action_register.php" method="post" class="form-container-reg" id="register">
      <h1>Register</h1>
      <div id="name">
        <label><b>Name</b><input type="text" placeholder="Enter Name" name="name"></label>   
      </div>
      <div id="phone">  
        <label><b>Phone</b><input type="phone" placeholder="Enter Phone Nr" name="phone"></label>
      </div>
      <div id="email">
        <label><b>Email</b><input type="email" placeholder="Enter Email" name="email" required></label>
      </div>
      <div id="password">
        <label><b>Password</b><input type="password" placeholder="Enter Password" name="password" required></label>
      </div>
      <div id="state"> 
        <label><b>State</b><input type="text" placeholder="Enter State" name="state"></label>   
      </div>
      <div id="city"> 
        <label><b>City</b><input type="text" placeholder="Enter City" name="city"></label>   
      </div>
      <div id="street"> 
        <label><b>Street</b><input type="text" placeholder="Enter Street" name="street"></label>   
      </div>
      <div id="postal-code">  
        <label><b>Postal Code</b><input type="text" placeholder="Enter Postal-code" name="postal-code"></label>   
      </div>

      <label><b>Restaurant Owner</b><input type="checkbox" name="restaurant-owner" id="restaurant-owner"></label>

      <p>Have an account? No problem, <a onclick="closeRegisterForm(); openLogInForm()" class="loginLink">log in.</a></p>
      
      <button type="submit" class="btn">Register</button>
      <button type="button" class="btn cancel" onclick="closeRegisterForm()">Close</button>
    </form>
  </section>

<?php } ?>

<?php function drawRegisterFormRestaurant() { ?>
  <form action="action_register_restaraunt.php" method="post" class="registerRestaraunt">

  </form>
<?php } ?>


<?php function drawSearchBar($categories) { ?>
  <div class="topnav" id="searchRestaurant">
    <input type="text" placeholder="Search..">
    <select id="select-category">
      <?php foreach ($categories as $category) {?>
        <option value=<?=$category->name?>><?=$category->name?></option>
      <?php } ?>
    </select>
    <button type="submit"><i class="fa fa-search"></i></button>
  </div>
<?php } ?>

<?php function drawCart() { ?>
  <div>
    <a id="cart" href="cart.php"><img src="images/cart.png" alt ="cart icon" width="30" height="30">(0<?php ?>)</a>
  </div>
<?php } ?>