<?php declare(strict_types = 1); ?>

<?php function drawRestaurants(array $restaurants) { ?>
  <h2>Restaurants</h2>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <img src="https://picsum.photos/200?<?=$restaurant->id?>">
        <a href="restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, array $menuItems) { ?>
  <h2><?=$restaurant->name?></h2>
  <section id="menuItems">
    <?php foreach ($menuItems as $menuItem) { ?>
    <article>
      <img src=<?=$menuItem->photo?>>
      <a href="item.php?id=<?=$menuItem->id?>"><?=$menuItem->name?></a>
    </article>
    <?php } ?>
  </section>
<?php } ?>

