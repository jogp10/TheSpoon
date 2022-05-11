<?php declare(strict_types = 1); ?>

<?php function drawProfile(User $user) { ?>
<h2>Profile</h2>
<section id="profile">
  <p>Email</p>
  <p>Phone</p>
  <p>Name</p>
  <p>Street State City</p>
    
  <?php if($user->restOwner) { ?>
    // RestOwner
  <?php } else { ?>
    <p>Change password</p>
  <?php } ?>
  
</section>
<?php } ?>