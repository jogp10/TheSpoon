<?php declare(strict_types = 1); ?>

<?php function drawRestaurants(PDO $db, array $categories) { ?>
  <section class="style-restaraunts" id="restaurants">
    <h2>Restaurants</h2>
    <?php foreach($categories as $category) { 
      $restaurants = Restaurant::getRestaurantsFromCategory($db, 8, $category->id);
      drawRestaurantsCategory($restaurants, $category);
    } ?>
  </section>
<?php } ?>

<?php function drawRestaurantsCategory(array $restaurants, Category $category) { ?>
  <section id=<?=$category->name?>>
    <div>
      <h3><?=$category->name?></h3>
      <p><?=$category->description?></p>
    </div>
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <div class="restImageName">
          <a href="restaurant.php?id=<?=$restaurant->id?>" class="restImage" id="restImage-<?=$restaurant->id?>"><img src="https://picsum.photos/200?<?=$restaurant->id?>" alt=""></a>
          <a href="restaurant.php?id=<?=$restaurant->id?>" class="restName" id="restName-<?=$restaurant->id?>"><?=$restaurant->name?></a>
          <p class="restDesc" id="restDesc-<?=$restaurant->id?>"><?=$restaurant->description?></p>
          <button type="button" class="descClose" id="descClose-<?=$restaurant->id?>" onclick="closeDescription(<?=$restaurant->id?>)">-</button>
          <button type="button" class="descOpen" id="descOpen-<?=$restaurant->id?>" onclick="openDescription(<?=$restaurant->id?>)">+</button>
        </div>      
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
        <h4><?=$menuItem->name?></h4>
        <img src=<?=$menuItem->photo?> alt=""></a>
        <button>Buy</button>
      </article>
    <?php } ?>
  </section>

  <section id="comments">
    <h2>Comments</h2>
    <?php foreach ($comments as $comment) { ?>
      <?php if($comment->comment != '') { ?>
        <article class="comment">
          <span class="user"><h4><?=$comment->nameUser?></h4></span>
          <span class="rating"><?=$comment->rating?>*</span>
          <span class="date"> </span>
          <p><?=$comment->comment?></p>
          <?php if($comment->answer != '') { ?>
            <span class="owner"><h4><?=$comment->nameOwner?></h4></span>
            <span class="date"> </span>
            <p><?=$comment->answer?></p>
          <?php } ?>
        </article>
    <?php } } ?>
    <form id="comment">
      <h3>Rate your experience</h3>
      <label>Rating<input type="number" name="rating"></label>
      <label>Comment<input type="text" name="comment"></label>
      <button formaction="#" formmethod="post" type="submit">Comment</button>
    </form>
  </section>
<?php } ?>

