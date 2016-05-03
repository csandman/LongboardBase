<!DOCTYPE HTML>
<html lang="en">
    <?php include ('top.php'); ?>
    <body id="home">
        <header><h1>LONGBOARD BASE</h1></header>
        <?php include ('nav.php'); ?>
        <div class="background">
            <h1 class="borderBottom">Home</h1>
            <div class="columnHolder borderBottom">
                <div class="column1">
                    <h3><a href="decks.php">Deck Database</a></h3>
                    <p>A database of longboard decks with descriptions, deck specifications, websites to buy from, and product videos.</p>
                    <h3><a href="newBoards.php">New Boards</a></h3>
                    <p>A collection decks added by users that have yet been added to the main database</p>
                </div>
                <div class="column2">
                    <h3><a href="form.php">Add a Deck</a></h3>
                    <p>Submit details about a specific deck that you would like to be added to the Deck Database.</p>
                    <h3><a href="guides.php">Guides</a></h3>
                    <p>A variety of guides on how to set up and maintain your longboard and how to do a variety of tricks. Guides are in both text and video form.</p>
                </div>
            </div>
            <h3>Featured Decks:</h3>
            <div class="decks">
                <?php
                $query = 'SELECT pmkBoard,fldBoardName,fldLength,fldBrand
                FROM tblBoards
                ORDER BY rand()
                limit 10';

                $decks = $thisDatabaseReader->select($query, "", 0, 1, 0, 0, false, false);

                foreach ($decks as $deck) {
                    $brandName = strtolower(preg_replace('/\s*/', '', $deck[3]));
                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </body>
</html>