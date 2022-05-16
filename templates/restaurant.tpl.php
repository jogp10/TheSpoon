<?php declare(strict_types = 1); ?>

<?php function drawRestaurants(array $restaurants) { ?>
  <h2>Restaurants</h2>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <a href="restaurant.php?id=<?=$restaurant->id?>">
        <img src="https://picsum.photos/200?<?=$restaurant->id?>">
        <?=$restaurant->name?></a>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, array $menuItems) { ?>
  <h2><?=$restaurant->name?></h2>
  <section id="menuItems">
    <?php foreach ($menuItems as $menuItem) { ?>
    <article>
      <a href="item.php?id=<?=$menuItem->id?>">
      <img src=<?=$menuItem->photo?>>
      <?=$menuItem->name?></a>
      <button>Buy</button>
    </article>
    <?php } ?>
  </section>
<?php } ?>

