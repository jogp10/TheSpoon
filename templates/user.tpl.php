<?php declare(strict_types = 1); ?>

<?php function drawProfile(User $user) { ?>
  <h2>Profile</h2>
  <section id="profile">
  <p>Name</p>
    <p><?php echo $user->name ?></p>
    <p>Email</p>
    <p><?php echo $user->email ?></p>
    <p>Phone</p>
    <p><?php echo $user->phone ?></p>
    <p>Street State City</p>
    <p><?php echo $user->street ?>,
    <?php echo $user->state?>,
    <?php echo $user->city ?></p>
      
    <?php if($user->restOwner) { ?>
      <p>Restaurants</p>
    <?php } else { ?>
      <p>Orders</p>
    <?php } ?>
    <button>Change password</button>
    
  </section>
<?php } ?>