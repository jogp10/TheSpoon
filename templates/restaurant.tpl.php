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
          <a href="../pages/restaurant.php?id=<?=$restaurant->id?>" class="restImage" id="restImage-<?=$restaurant->id?>"><img src="<?=$restaurant->photo?>" alt="restaurant image" width="200" height="200"></a>
          <a href="../pages/restaurant.php?id=<?=$restaurant->id?>" class="restName" id="restName-<?=$restaurant->id?>"><?=$restaurant->name?></a>
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
      <div class="restImageName">
        <a href="../pages/restaurant_info.php?id=<?=$restaurant->id?>" class="restImage" id="restImage-<?=$restaurant->id?>"><img src="<?=$restaurant->photo?>" alt="restaurant image" width="200" height="200"></a>
        <a href="../pages/restaurant_info.php?id=<?=$restaurant->id?>" class="restName" id="restName-<?=$restaurant->id?>"><?=$restaurant->name?></a>
        <p class="restDesc" id="restDesc-<?=$restaurant->id?>"><?=$restaurant->description?></p>
        <button type="button" class="descClose" id="descClose-<?=$restaurant->id?>" onclick="closeDescription(<?=$restaurant->id?>)">-</button>
        <button type="button" class="descOpen" id="descOpen-<?=$restaurant->id?>" onclick="openDescription(<?=$restaurant->id?>)">+</button>
      </div>  
    </article>
  <?php } ?>
<?php } ?>

<?php function drawRestaurant(Session $session, Restaurant $restaurant, User $restOwner, array $menuItems, array $comments) { ?>
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
  <?= drawComments($session, $restaurant, $restOwner, $comments)?>
<?php } ?>

<?php function drawRestaurantProfile(Restaurant $restaurant, array $categories, Category $category) { ?>
  <h1><?=$restaurant->name?></h1>
  <section>
    <form action="../actions/action_profile.php?id=<?=$restaurant->id?>" method="post">
      <label>Name<br>
      <input type="text" name="name" placeholder="name" value= "<?php echo $restaurant->name ?>" required></label>
      <br>
      <label>Category<br>
      <div>
        <select name="RestCategory"> 
          <option value="<?=$category->name?>">curr:<?=$category->name?></option>
          <?php foreach ($categories as $category) {?>
            <option value=<?=$category->name?>><?=$category->name?></option>
          <?php } ?>
        </select> 
      </div></label>
      <label>Description<br>
      <textarea id="desc" name="desc" rows="10" cols="50" placeholder="descritption"><?php echo $restaurant->description ?></textarea>
      </label>
      <br>
      <label>Address<br>
      <input type="text" name="street" placeholder="Street" value="<?php echo $restaurant->street ?>" required>
      <input type="text" name="city" placeholder="City" value="<?php echo $restaurant->city ?>" required>
      <input type="text" name="state" placeholder="State" value="<?php echo $restaurant->state ?>" required>
      <br>
      <input type="number" name="postal-code" placeholder="Postal Code" value="<?php echo $restaurant->postalcode ?>">
      </label>
      <br>
      <button type="submit">Save</button>
    </form>
  </section>
<?php } ?>

<?php function drawComments(Session $session, Restaurant $restaurant, User $restOwner, array $comments) { ?>
  <section class="comment-section" id="comments">
    <h2>Comments</h2>
    <?php if(count($comments) != 0 || $session->isLoggedIn()) { ?>
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
          <?php } else if ($session->getId()==$restOwner->idUser) { ?>
            <button type="sumbit">Answer</button>
            <form action="../actions/action_answer.php" method="post" id="answer-<?= $session->getId() ?>">
              <input type="hidden" name="idReview" value="<?php echo $comment->id ?>">
              <label><input type="text" name="answer" placeholder="Answer here..."></label>
              <button type="sumbit">Submit</button>
            </form>
          <?php } ?>
          <hr>
        </article>
    <?php } } } ?>

    <?php if ($session->isLoggedIn() && $session->getId()!=$restOwner->idUser) { ?>
    <form action="../actions/action_comment.php" method="post" id="comment-<?= $session->getId() ?>">
      <h3>Rate your experience</h3>
      <input type="hidden" name="idRestaurant" value="<?php echo $restaurant->id ?>">
      <label>Rating<input type="number" name="rating" min="1" max="5" required></label>
      <label>Comment<input type="text" name="comment" value=""></label>
      <button type="submit">Comment</button>
    </form>
    <?php } ?>
  </section>
<?php } ?>