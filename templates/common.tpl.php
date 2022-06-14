<?php 
  declare(strict_types = 1); 
  require_once('../utils/session.php');
?>

<?php function drawHeader(Session $session) { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>The Spoon</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="../css/mainpage.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/restaurant.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../javascript/search.js" defer=""></script>
    <script src="../javascript/header.js" defer=""></script>
    <script src="../javascript/cart.js" defer=""></script>
    <script src="../javascript/top.js" defer=""></script>
  </head>
  <body>

    <header id="header">
      <a id="logo" href="/"><img src="../images/TheSpoon.png" alt ="theSpoon logo" width="300" height="200"></a>
      <?php 
        if ($session->isLoggedIn()) drawLogoutForm($session);
        else drawLogInForm();
      ?>
    </header>

    <section id="messages">
      <?php foreach ($session->getMessages() as $messsage) { ?>
        <article class="<?=$messsage['type']?>">
          <?=$messsage['text']?>
        </article>
      <?php } ?>
    </section>
  
    <main class="content">
<?php } ?>

<?php function drawFooter() { ?>
    </main>
    <button onclick="toTopFunc()" id="goToTop" title="Go to top">Top</button> 
    <footer class="footer">
      The Spoon &copy; 2022
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawLogInForm() { ?> 
  <button type="button" class="open-button" id="logInButton" onclick="openLogInForm()">Login</button>
  <div class="form-popup" id="loginForm">
    <form action="../actions/action_login.php" method="post" class="form-container">
      <h1>Login</h1>

      <label><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" class="email" required>
      
      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" class="password" required>
      
      <p>Don't have an account? No problem, <a onclick="closeLogInForm(); openRegisterForm()" class="registerLink">register.</a></p>

      <button type="submit" class="btn">Login</button>
      <button type="button" class="btn cancel" onclick="closeLogInForm()">Close</button>
    </form>
  </div>
  <?=drawRegisterForm();?>
<?php } ?>

<?php function drawLogoutForm(Session $session) { ?>
  <form action="../actions/action_logout.php" method="post" class="logout">
    <div class="userName">
      <?php if($session->getOwner()) { ?>
        <a href="../pages/profile.php"  id="profileOwner" class="profile">Profile</a>
        <button type="submit" id="logOutButton" class="open-button">Logout</button>
        <a href="../pages/register_rest.php" id="restRegister">Register Your Restaurant</a>
      <?php } else { ?>
        <a href="../pages/profile.php" id="profileNotOwner" class="profile">Profile</a>
        <button type="submit" id="logoutNotOwner" class="open-button">Logout</button>
      <?php } ?>
    </div>
  </form>
<?php } ?>

<?php function drawRegisterForm() { ?>
  <button type="button" class="open-button" id="registerButton" onclick="openRegisterForm()">Register</button>
  <div class="form-popup-reg" id="registerForm">
    <form action="../actions/action_register.php" method="post" class="form-container-reg" id="register">
      <h1>Register</h1>
      <div id="name">
        <label><b>Name</b><input type="text" placeholder="Enter Name" name="name"></label>   
      </div>
      <div id="phone">  
        <label><b>Phone</b><input type="tel" placeholder="Enter Phone Nr" name="phone"></label>
      </div>
      <div id="email">
        <label><b>Email</b><input type="email" placeholder="Enter Email" name="email-reg" required></label>
      </div>
      <div id="password">
        <label><b>Password</b><input type="password" placeholder="Enter Password" name="password-reg" required></label>
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

<?php function drawRegisterFormRestaurant(array $categories) { ?>
  <form action="../actions/action_register_restaurant.php" method="post" enctype="multipart/form-data" class="registerRestaraunt">
    <h1>Register your restaurant</h1>
    <div id="name">
      <label><b>Name</b><input type="text" placeholder="Enter Name" name="rest_name"></label>   
    </div>
    <div>
      <select name="RestCategory"> 
        <option value="none">Select Category</option>
        <?php foreach ($categories as $category) {?>
          <option value=<?=$category->name?>><?=$category->name?></option>
        <?php } ?>
      </select> 
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

    <button type="submit" class="btn">Register Restaurant</button>
  </form>
<?php } ?>


<?php function drawSearchBar(array $categories) { ?>
  <div class="topnav" id="searchRestaurant">
    <input type="text" placeholder="Search..">
    <select id="select-category">
      <option value="none">Select Category</option>
      <?php foreach ($categories as $category) {?>
        <option value=<?=$category->name?>><?=$category->name?></option>
      <?php } ?>
    </select>
    <button type="submit"><i class="fa fa-search"></i></button>
  </div>
<?php } ?>

<?php function drawCart(Session $session, int $idRestaurant) { ?>
  
  <form name="checkout" method="POST" id="checkout-form" onsubmit="checkoutEvent()" action="../actions/action_order.php">
    <input name="price" type="hidden">
    <input name="idRest" type="hidden" value=<?=$idRestaurant?>>
  </form>
  
  <section id="cart">
    <div>
      <p><img src="../images/cart.png" alt ="cart icon" width="30" height="30">(0)</p>
    </div>
    <table>
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <form method="post" action=""><th colspan="4">Total:</th></form>
          <th>0€</th>
        </tr>
      </tfoot>
    </table>
    <?php 
        if ($session->isLoggedIn()) goToCheckout();
        else openRegForm();
      ?>
  </section>
<?php } ?>


<?php function openRegForm() { ?>
  <button onclick="openRegisterForm()">Checkout</button>
<?php } ?>

<?php function goToCheckout() { ?>
  <a href="../pages/checkout.php"><button form="checkout-form">Checkout</button></a>
<?php } ?>


<?php function drawRegisterFormMenuItem(int $id) { ?>
  <form action="../actions/action_register_menu_item.php?id=<?= $id ?>" method="post" enctype="multipart/form-data" class="registerRestaraunt">
    <h1>Register a new dish</h1>
    <div id="name">
      <label><b>Name</b><input type="text" placeholder="Enter Name of Dish" name="item_name"></label>   
    </div>
    <div id="item-price">  
      <label><b>Price</b><input type="text" placeholder="Enter Price" name="price"></label>   
    </div>

    <button type="submit" class="btn">Register Dish</button>
  </form>
<?php } ?>