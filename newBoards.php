<!DOCTYPE HTML>
<html lang="en">
    <?php include ('top.php'); ?>
    <body id="newBoards">
        <header><h1>LONGBOARD BASE</h1></header>
        <?php include ('nav.php'); ?>
        <div class="background">
            <h1 class="borderBottom">User Added Decks</h1>
            <div class="decks">
                <?php
                $query = 'SELECT pmkBoard,fldBoardName,fldLength 
                FROM tblNewBoards 
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 0, 1, 0, 0, false, false);
                
                foreach ($decks as $deck) {
                    if (!file_exists('temp/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick( 'temp/images/' . $deck[0] . '.png');              
                        $image->thumbnailImage( 0, round($deck[2]*10));
                        $newFileName = 'temp/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }
                    
                    print'<div class="gallery">';
                    print'<a href="temp/'.$deck[0] .'.php"></a>';
                    print'<div><img src="temp/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>


            <?php include('footer.php'); ?>
        </div>
    </body>
</html>