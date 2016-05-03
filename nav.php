<nav id="menu">
    <ul>
        <?php
        if ($path_parts['filename'] == "home") {
            print '<li class="activePage"><a href="' . $host . '/home.php" onclick="return false">Home</a></li>';
        } else {
            print '<li><a href="' . $host . '/home.php">Home</a></li>';
        }

        if ($path_parts['filename'] == "decks") {
            print '<li class="activePage"><a href="' . $host . '/home.php" onclick="return false">Deck Database</a></li>';
        } else {
            print '<li><a href="' . $host . '/decks.php">Deck Database</a></li>';
        }

        if ($path_parts['filename'] == "resources") {
            print '<li class="activePage"><a href="' . $host . '/home.php" onclick="return false">Links</a></li>';
        } else {
            print '<li><a href="' . $host . '/resources.php">Links</a></li>';
        }

        if ($path_parts['filename'] == "form") {
            print '<li class="activePage"><a href="' . $host . '/home.php" onclick="return false">Add a Deck</a></li>';
        } else {
            print '<li><a href="' . $host . '/form.php">Add a Deck</a></li>';
        }
        
        if ($path_parts['filename'] == "guides") {
            print '<li class="activePage"><a href="' . $host . '/home.php" onclick="return false">Guides</a></li>';
        } else {
            print '<li><a href="' . $host . '/guides.php">Guides</a></li>';
        }

        if ($path_parts['filename'] == "newBoards") {
            print '<li class="activePage"><a href="' . $host . '/home.php" onclick="return false">New Boards</a></li>';
        } else {
            print '<li><a href="' . $host . '/newBoards.php">New Boards</a></li>';
        }
        ?>
    </ul>
</nav>