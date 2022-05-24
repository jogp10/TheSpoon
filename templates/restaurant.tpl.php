<?php declare(strict_types = 1); ?>

<?php function drawRestaurants(PDO $db, array $categories) { ?>
  <section class="style-restaraunts" id="restaurants">
    <h2>Restaurants</h2>
    <?php foreach($categories as $category) { 
      $restaurants = Restaurant::getRestaurantsFromCategory($db, 5, $category->id);
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
          <a href="restaurant.php?id=<?=$restaurant->id?>" class="restImage" id="restImage-<?=$restaurant->id?>"><img src="https://picsum.photos/200?<?=$restaurant->id?>" alt="restaurant image" width="200" height="200"></a>
          <a href="restaurant.php?id=<?=$restaurant->id?>" class="restName" id="restName-<?=$restaurant->id?>"><?=$restaurant->name?></a>
          <p class="restDesc" id="restDesc-<?=$restaurant->id?>"><?=$restaurant->description?></p>
          <button type="button" class="descClose" id="descClose-<?=$restaurant->id?>" onclick="closeDescription(<?=$restaurant->id?>)">-</button>
          <button type="button" class="descOpen" id="descOpen-<?=$restaurant->id?>" onclick="openDescription(<?=$restaurant->id?>)">+</button>
        </div>      
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawOwnerRestaurants(array $restaurants) { ?>
  <p>Restaurants</p>
  <?php foreach($restaurants as $restaurant) { ?> 
    <article>
      <div>
        <a href="restaurant.php?id=<?=$restaurant->id?>"><img src="https://picsum.photos/200?<?=$restaurant->id?>" alt="restaurant image" width="200" height="200"></a>
        <a href="restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a>
        <p ><?=$restaurant->description?></p>
      </div>      
    </article>
  <?php } ?>
<?php } ?>

<?php function drawRestaurant(Restaurant $restaurant, User $restOwner, array $menuItems, array $comments) { ?>
  <h1><?=$restaurant->name?></h1>
  <section id="menuItems">
    <?php foreach ($menuItems as $menuItem) { ?>
      <article data-id="<?=$menuItem->id?>">
        <a href="item.php?id=<?=$menuItem->id?>">
        <h4><?=$menuItem->name?></h4>
        <img src=<?=$menuItem->photo?> alt="item image" width="200" height="200"></a>
        <p class="price" price="<?=$menuItem->price?>"><?=$menuItem->price?>€</p>
        <input class="quantity" type="hidden" value="1">
        <button>Buy</button>
      </article>
    <?php } ?>
  </section>
  <?= drawComments($restaurant, $restOwner, $comments)?>
<?php } ?>

<?php function drawComments(Restaurant $restaurant, User $restOwner, array $comments) { ?>
  <section class="comment-section" id="comments">
    <h2>Comments</h2>
    <?php if(count($comments) != 0 || isset($_SESSION['id'])) { ?>
    <?php foreach ($comments as $comment) { ?>
      <?php if($comment->comment != '') { ?>
        <article class="comment">
          <div class ="customer-comment">
            <span class="user"><h4><?=$comment->nameUser?></h4></span>
            <span class="rating">rating: <?=$comment->rating?>*</span>
            <span class="date">date: </span>
            <p><?=$comment->comment?></p>
          </div>
          <?php if($comment->answer != '') { ?>
            <div class="owner-answer">
              <span class="owner"><h4><?=$comment->nameOwner?></h4></span>
              <span class="date"> </span>
              <p><?=$comment->answer?></p>
            </div>
          <?php } else if ($_SESSION['id']==$restOwner->idUser) { ?>
            <button type="sumbit">Answer</button>
            <form action="action_answer.php" method="post" id="answer-<?php echo $_SESSION['id'] ?>">
              <input type="hidden" name="idReview" value="<?php echo $comment->id ?>">
              <label><input type="text" name="answer" placeholder="Answer here..."></label>
              <button type="sumbit">Submit</button>
            </form>
          <?php } ?>
          <hr>
        </article>
    <?php } } } ?>

    <?php if (isset($_SESSION['id']) && $_SESSION['id']!=$restOwner->idUser) { ?>
    <form action="action_comment.php" method="post" id="comment-<?php echo $_SESSION['id'] ?>">
      <h3>Rate your experience</h3>
      <input type="hidden" name="idRestaurant" value="<?php echo $restaurant->id ?>">
      <label>Rating<input type="number" name="rating" min="1" max="5" required></label>
      <label>Comment<input type="text" name="comment" value=""></label>
      <button type="submit">Comment</button>
    </form>
    <?php } ?>
  </section>
<?php } ?>