
<!DOCTYPE html>
<html lang="en-US">

<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <title>The Spoon</title>
</head>
<body>
    <?php
        include("database/database.php");
        $db = new databaseManagement();
        $db->insertAddress('Porto', 'Porto', 'Rua do Jornal de Noticias', 4321123);
    ?>
    
    <header>
        <a href="index.php" title="Main Page">
            <h1>The Spoon</h1>
            <h5>Where you can eat until you roll!</h5>
            <img src="images/dog.jpg" alt ="a dog" width="300" height="200">
        </a>
        <div id="signup">
            <a href="php/register.php">Register</a>
            <a href="php/login.php">Login</a>
        </div>
    </header>
    <form method="get">
        <label>&#128270;
            <input id="search" type="text" name="search" placeholder="search...">
        </label>
        <select name="category">
            <option value="" disabled selected>Categories</option>
            <option value="Burgers">Burgers</option>
            <option value="Pizza">Pizza</option>
            <option value="Sushi">Sushi</option>
            <option value="Pasta">Pasta</option>
        </select>
        <input type="submit" value="Search">
    </form>
    <nav>
        <h3>Featured Restaurants</h3>
        <ul>
            <li>
                <a href="index.php"><img src="images/dog.jpg" alt="A dog" width="250" height="200"></a>
                <p>Pizza place</p>
            </li>
            <li>
                <a href="index.php"><img src="images/dog.jpg" alt="A dog" width="250" height="200"></a>
                <p>Not Sushi italian</p>
            </li>
            <li>
                <a href="index.php"><img src="images/dog.jpg" alt="A dog" width="250" height="200"></a>
                <p>I'm not hungry, whatever</p>
            </li>
            <li>
                <a href="index.php"><img src="images/dog.jpg" alt="A dog" width="250" height="200"></a>
                <p>Amy's Baking Company</p>
            </li>
        </ul>
    </nav>
    <section>
        <article>

        </article>
    </section>

    <footer>
        <h4>The Spoon &copy; 2022</h4>
    </footer>
    
</body>

</html>
