<?php declare(strict_types = 1); ?>

<?php function drawProfile(User $user) { ?>
  <h2>Profile</h2>
  <section id="profile">
  <p>Name</p>
    <h3><?php echo $user->name ?></h3>
    <p>Email</p>
    <h4><?php echo $user->email ?></h4>
    <p>Phone</p>
    <h4><?php echo $user->phone ?></h4>
    <p>Street State City</p>
    <h4><?php echo $user->street ?>,
    <?php echo $user->state?>,
    <?php echo $user->city ?></h4>
      
    <?php if($user->restOwner) { ?>
      <p>Restaurants</p>
    <?php } else { ?>
      <p>Orders</p>
    <?php } ?>
    <button>Change password</button>
    
  </section>
<?php } ?>