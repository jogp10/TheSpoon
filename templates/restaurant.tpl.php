<?php declare(strict_types = 1);
  require_once('../database/order.class.php');
?>

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
          <a href="../pages/restaurant.php?id=<?=$restaurant->id?>" class="restName" id="restName-<?=$restaurant->id?>"><?=htmlentities($restaurant->name)?> <?=$restaurant->rating?> star</a>
          <p class="restDesc" id="restDesc-<?=$restaurant->id?>"><?=htmlentities($restaurant->description)?></p>
          <button type="button" class="descClose" id="descClose-<?=$restaurant->id?>" onclick="closeDescription(<?=$restaurant->id?>)">-</button>
          <button type="button" class="descOpen" id="descOpen-<?=$restaurant->id?>" onclick="openDescription(<?=$restaurant->id?>)">+</button>
        </div>      
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawOwnerRestaurants(array $restaurants) { ?>
  <p>Restaurants</p>
  <section class="user-restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>    
        <div class="restImageName">
          <a href="../pages/restaurant_info.php?id=<?=$restaurant->id?>" class="restImage" id="restImage-<?=$restaurant->id?>"><img src="<?=$restaurant->photo?>" alt="restaurant image" width="200" height="200"></a>
          <a href="../pages/restaurant_info.php?id=<?=$restaurant->id?>" class="restName" id="restName-<?=$restaurant->id?>"><?=htmlentities($restaurant->name)?> <?=$restaurant->rating?> star</a>
          <p class="restDesc" id="restDesc-<?=$restaurant->id?>"><?=htmlentities($restaurant->description)?></p>
          <button type="button" class="descClose" id="descClose-<?=$restaurant->id?>" onclick="closeDescription(<?=$restaurant->id?>)">-</button>
          <button type="button" class="descOpen" id="descOpen-<?=$restaurant->id?>" onclick="openDescription(<?=$restaurant->id?>)">+</button>
        </div>  
      </article>
    <?php } ?>
  </section>
<?php } ?>

<?php function drawRestaurant(Session $session, Restaurant $restaurant, User $restOwner, array $menuItems, array $comments) { 
  drawName($restaurant); 
  if ($session->isLoggedIn() && !isfavoriteR($restaurant)) drawFavorite($restaurant);
  if ($session->isLoggedIn() && isfavoriteR($restaurant)) drawUnfavorite($restaurant);

  if($session->getId() != $restOwner->idUser) drawCart($session, $restaurant->id);

  drawItems($session, $menuItems, $restOwner->idUser);
  drawComments($session, $restaurant, $restOwner, $comments);
} ?>


<?php function drawRestaurantProfile(Restaurant $restaurant, array $categories, Category $category) { ?>
  <h1><?=htmlentities($restaurant->name)?></h1>
  <section>
    <form action="../actions/action_restaurant_profile.php?id=<?=$restaurant->id?>" method="post" enctype="multipart/form-data">
      <label>Name<br>
      <input type="text" name="rest_name" placeholder="name" value= "<?php echo $restaurant->name ?>" required></label>
      <br>
      <label>Category<br>
      <div>
        <select name="RestCategory"> 
          <option value="<?=$category->name?>"><?=$category->name?></option>
          <?php foreach ($categories as $category) {?>
            <option value=<?=$category->name?>><?=$category->name?></option>
          <?php } ?>
        </select> 
      </div></label>
      <label>Description<br>
      <textarea id="desc" name="desc" rows="10" cols="50" placeholder="descritption"><?php echo htmlentities($restaurant->description) ?></textarea>
      </label>
      <br>
      <label>Address<br>
      <input type="text" name="street" placeholder="Street" value="<?php echo htmlentities($restaurant->street) ?>" required>
      <input type="text" name="city" placeholder="City" value="<?php echo htmlentities($restaurant->city) ?>" required>
      <input type="text" name="state" placeholder="State" value="<?php echo htmlentities($restaurant->state) ?>" required>
      <br>
      <input type="number" name="postal-code" placeholder="Postal Code" value="<?php echo $restaurant->postalcode ?>">
      </label>
      <br>
      <label>Photo<br>
      <img src=<?=$restaurant->photo?> alt="item image" width="200" height="200"><br>
      <input type="file" name="uploadPhoto" id="uploadPhoto" accept="image/png, image/jpeg"><br>
      </label>
      <button type="submit">Save</button>
    </form>
    <a href="../pages/register_menu_item.php?id=<?=$restaurant->id?>" method="get">Add dishes to the restaurant</a>
    <div>
      <a href="../pages/view_orders.php?id=<?=$restaurant->id?>" method="get">View Orders</a>
    </div>
  </section>
<?php } ?>

<?php function buyItem() { ?>
  <input class="quantity" type="hidden" value="1">
  <button>Buy</button>
<?php } ?>

<?php function openRegForm2() { ?>
  <button onclick="openRegisterForm()">Buy</button>
<?php } ?>

<?php function drawComments(Session $session, Restaurant $restaurant, User $restOwner, array $comments) { ?>
  <section class="comment-section" id="comments">
    <h2>Comments</h2>
    <?php if(count($comments) != 0 || $session->isLoggedIn()) { ?>
    <?php foreach ($comments as $comment) { ?>
      <?php if($comment->comment != '') { ?>
        <article class="comment">
          <div class ="customer-comment">
            <span class="user"><h4><?=htmlentities($comment->nameUser)?></h4></span>
            <span class="rating">rating: <?=$comment->rating?>*</span>
            <p><?=htmlentities($comment->comment)?></p>
          </div>
          <?php if($comment->answer != '') { ?>
            <div class="owner-answer">
              <span class="owner"><h4><?=htmlentities($comment->nameOwner)?></h4></span>
              <span class="date"> </span>
              <p><?=htmlentities($comment->answer)?></p>
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

    <?php if ($session->isLoggedIn() && $session->getId()!=$restOwner->idUser && Order::hasOrder($session->getId(), $restaurant->id)) { ?>
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

<?php function drawName(Restaurant $restaurant) { ?>
  <h1><?=htmlentities($restaurant->name)?> <?=$restaurant->rating?>star</h1>
<?php } ?>

<?php function drawItems(Session $session, array $menuItems, int $restOwner) { ?>
  <section id="menuItems">
    <?php foreach ($menuItems as $menuItem) { ?>
      <article data-id="<?=$menuItem->id?>">
        <h4><?=htmlentities($menuItem->name)?></h4>
        <img src=<?=$menuItem->photo?> alt="item image" width="200" height="200"></a>
        <p class="price" price="<?=$menuItem->price?>"><?=$menuItem->price?>€</p>
        
        <?php 
          if ($session->isLoggedIn() && !isfavorite($menuItem)) favorite($menuItem);
          if ($session->isLoggedIn() && isfavorite($menuItem)) unfavorite($menuItem);
        ?>

        <?php 
          if ($session->isLoggedIn() && $session->getId() != $restOwner) buyItem();
          if(!$session->isLoggedIn()) openRegForm2();
        ?>
      </article>
    <?php } ?>
  </section>


<?php } ?>

<?php function isfavorite(MenuItem $item) {
  require_once('../utils/session.php');
  require_once('../database/connection.php');
  $session = new Session();
  $db = getDatabaseConnection();
  $stmt = $db->prepare(
    'SELECT * 
    FROM    ItemFavorite
    WHERE   idMenuItem = ? AND idUser = ?'
  );
  $stmt->execute(array($item->id, $session->getId()));
  $favorite = $stmt->fetch();
  return $favorite;
} ?>

<?php function isfavoriteR(Restaurant $restaurant) {
  require_once('../utils/session.php');
  require_once('../database/connection.php');
  $session = new Session();
  $db = getDatabaseConnection();
  $stmt = $db->prepare(
    'SELECT * 
    FROM    RestFavorite
    WHERE   idRestaurant = ? AND idUser = ?'
  );
  $stmt->execute(array($restaurant->id, $session->getId()));
  $favorite = $stmt->fetch();
  return $favorite;
} ?>

<?php function drawItemsInfo(Session $session, Restaurant $restaurant, array $menuItems) { ?>
  <section id="menuItems">
    <?php foreach ($menuItems as $menuItem) { ?>
      <article data-id="<?=$menuItem->id?>">
        <a href="item_info.php?id=<?=$menuItem->id?>">
        <h4><?=htmlentities($menuItem->name)?></h4>
        <img src=<?=$menuItem->photo?> alt="item image" width="200" height="200"></a>
        <p class="price" price="<?=$menuItem->price?>"><?=$menuItem->price?>€</p>
      </article>
    <?php } ?>
  </section>
<?php } ?>


<?php function drawItemProfile(Session $session, MenuItem $item) { ?>
  <h1><?=$item->name?></h1>
  <section>
    <form action="../actions/action_item_profile.php?id=<?=$item->id?>" method="post" enctype="multipart/form-data">
      <label>Name<br>
      <input type="text" name="item_name" placeholder="name" value= "<?php echo htmlentities($item->name) ?>" required></label>
  
      <label>Price<br>
      <input type="number" name="item_price" placeholder="price" value="<?php echo $item->price ?>" required></label>
   
      <label>Photo<br>
      <img src=<?=$item->photo?> alt="item image" width="200" height="200"><br>
      <input type="file" name="uploadPhoto" id="uploadPhoto" accept="image/png, image/jpeg"><br>
      </label>
      <button type="submit">Save</button>
      
    </form>
  </section>
<?php } ?>


<?php function favorite(MenuItem $item) { ?>
  <section>
    <form action="../actions/action_item_favorite.php?id=<?=$item->id?>" method="post" enctype="multipart/form-data">
      <button type="submit">Favorite</button>
    </form>
  </section>
<?php } ?>

<?php function unfavorite(MenuItem $item) { ?>
  <section>
    <form action="../actions/action_item_unfavorite.php?id=<?=$item->id?>" method="post" enctype="multipart/form-data">
      <button type="submit">Unfavorite</button>
    </form>
  </section>
<?php } ?>


<?php function drawFavorite(Restaurant $restaurant) { ?>
  <section>
    <form action="../actions/action_rest_favorite.php?id=<?=$restaurant->id?>" method="post" enctype="multipart/form-data">
      <button type="submit">Favorite</button>
    </form>
  </section>
<?php } ?>


<?php function drawUnfavorite(Restaurant $restaurant) { ?>
  <section>
    <form action="../actions/action_rest_unfavorite.php?id=<?=$restaurant->id?>" method="post" enctype="multipart/form-data">
      <button type="submit">Unfavorite</button>
    </form>
  </section>
<?php } ?>

<?php function drawOrders(array $orders) { ?>
  <h3>Orders:</h3>
  <?php 
  require_once('../database/connection.php');
  $db = getDatabaseConnection();
  ?>
  <section id="orders">
    <?php foreach ($orders as $order) { ?>
      <article data-id="<?=$order->id?>">
      <form action="../actions/action_order_state.php?id=<?=$order->id?>" method="post" enctype="multipart/form-data">
          <p>#<?= $order->id ?>  Ordered at: <?= $order->orderTime ?>  -  Total: <?= $order->totalPrice ?>€  -  State:
            <select name="State">
              <?php 
              if ($order->state == "Received") selected("Received"); 
              else unselected("Received");
              if ($order->state == "Preparing") selected("Preparing"); 
              else unselected("Preparing");
              if ($order->state == "Ready") selected("Ready"); 
              else unselected("Ready");
              if ($order->state == "Delivered") selected("Delivered"); 
              else unselected("Delivered");
              ?>
            </select> 
            <button type="submit">Save</button>
          </p>
        </form>
      </article>
    <?php } ?>
  </section>

<?php } ?>

<?php function selected(string $state){ ?>
  <option value="<?=$state?>" selected><?=$state?></option>
<?php } ?>
<?php function unselected(string $state){ ?>
  <option value="<?=$state?>"><?=$state?></option>
<?php } ?>