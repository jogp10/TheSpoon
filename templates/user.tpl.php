<?php 
  declare(strict_types = 1);
 ?>

<?php function drawProfile(User $user) { ?>
  <h2>Profile</h2>
  <section id="profile">
    <form action="../actions/action_profile.php" method="post" id="profile-info" class="form-container-reg">
      <div id="name">
        <label><b>Name</b><input type="text" name="name" placeholder="name" value= "<?php echo $user->name ?>" required></label>   
      </div>
      <div id="phone">
        <label><b>Phone</b><input type="tel" name="phone" placeholder="phone" value= "<?php echo $user->phone ?>" required></label>   
      </div>
      <div id="email">
        <label><b>Email</b><input type="text" name="email" placeholder="email" value= "<?php echo $user->email ?>" required></label>   
      </div>
      <div id="state"> 
        <label><b>State</b><input type="text" name="state" placeholder="State" value="<?php echo $user->state ?>" required></label>   
      </div>
      <div id="city"> 
        <label><b>City</b><input type="text" name="city" placeholder="City" value="<?php echo $user->city ?>" required></label>   
      </div>
      <div id="street"> 
        <label><b>Street</b><input type="text" name="street" placeholder="Street" value="<?php echo $user->street ?>" required></label>   
      </div>
      <div id="postal-code">  
        <label><b>Postal Code</b><input type="number" name="postal-code" placeholder="Postal Code" value="<?php echo $user->postalcode ?>" required></label>   
      </div>

      <button type="submit" class="btn">Save</button>
    </form>
  </section>
<?php } ?>

<?php function drawOrderHistory(PDO $db, array $orders) { ?>
  <section class="order-history">
    <h2>Order History</h2>
    <div>
      <?php foreach($orders as $order) { 
        $restaurant = Restaurant::getRestaurant($db, $order->idRestaurant);
        ?>
        <?=$restaurant->name?> - <?=$order->orderTime?> - <?=$order->totalPrice?>€ - <?=$order->state?><br>
      <?php } ?>
    </div>
  </section>
<?php } ?>
