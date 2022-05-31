<?php declare(strict_types = 1); ?>

<?php function drawProfile(User $user) { ?>
  <h2>Profile</h2>
  <section id="profile">
    <form action="actions/action_profile.php" method="post" id="profile-info">
      <label>Name<br>
      <input type="text" name="name" placeholder="name" value= "<?php echo $user->name ?>" required></label>
      <br>
      <label>Email<br>
      <input type="email" name="email" placeholder="email" value= "<?php echo $user->email ?>" required></label>
      <br>
      <label>Phone<br>
      <input type="tel" name="phone" placeholder="phone" value= "<?php echo $user->phone ?>" required></label>
      <br>
      <label>Address<br>
      <input type="text" name="street" placeholder="Street" value="<?php echo $user->street ?>" required>
      <input type="text" name="city" placeholder="City" value="<?php echo $user->city ?>" required>
      <input type="text" name="state" placeholder="State" value="<?php echo $user->state ?>" required>
      <br>
      <input type="number" name="postal-code" placeholder="Postal Code" value="<?php echo $user->postalcode ?>">
      </label>
      <br>
      <button type="submit">Save</button>
    </form>
    <button>Change Password</button> 
  </section>
<?php } ?>
