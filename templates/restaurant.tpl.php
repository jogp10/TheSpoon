<?php declare(strict_types = 1); ?>

<?php function drawRestaurants(PDO $db, array $categories) { ?>
  <section id="restaurants">
    <h1>Restaurants</h1>
    <?php foreach($categories as $category) { 
      $restaurants = Restaurant::getRestaurantsFromCategory($db, 8, $category->id);
      drawRestaurantsCategory($restaurants, $category);
    } ?>
  </section>
<?php } ?>

<?php function drawRestaurantsCategory(array $restaurants, Category $category) { ?>
  <section id=<?=$category->name?>>
    <h2><?=$category->name?></h2>
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <a href="restaurant.php?id=<?=$restaurant->id?>">
        <img src="https://picsum.photos/200?<?=$restaurant->id?>">
        <?=$restaurant->name?></a>
        <p><?=$restaurant->description?></p>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, array $menuItems, array $comments) { ?>
  <h1><?=$restaurant->name?></h1>
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

  <section id="comments">
    <?php foreach ($comments as $comment) { ?>
      <h2>Comments</h2>
      <?php if($comment->answer != '') { ?>
        <article class="comment">
          <span class="user"><?=$comment->nameUser?></span>
          <span class="rating"><?=$comment->rating?>*</span>
          <span class="date"> </span>
          <p><?=$comment->comment?></p>
          <?php if($comment->answer != '') { ?>
            <span class="owner"><?=$comment->nameOwner?></span>
            <span class="date"> </span>
            <p><?=$comment->answer?></p>
          <?php } ?>
        </article>
    <?php } } ?>
    <form id="comment">
      <h3>Rate your experience</h3>
      <label>Rating<input type="integer" name="rating"></label>
      <label>Comment<input type="text" name="comment"></label>
      <button formaction="#" formmethod="post" type="submit">Comment</button>
    </form>

  </section>
<?php } ?>

