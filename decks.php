<!DOCTYPE HTML>
<html lang="en">
    <?php include ('top.php'); ?>
    <body id="decksBody">
        <header><h1>LONGBOARD BASE</h1></header>
        <?php include ('nav.php'); ?>
        <p class="print">This page does not print well.</p>
        <div class="background">

            <!-- creates all board pages that do not already exist -->
            <?php
            ////////////////////////////////////////////////////////////////////
            $query = 'SELECT pmkBoard,fldBrand
                FROM tblBoards
                ORDER BY fldBoardName ASC';
            $decks = $thisDatabaseReader->select($query, "", 0, 1, 0, 0, false, false);
            foreach ($decks as $deck) {
                if (!file_exists(strtolower(preg_replace('/\s*/', '', $deck[1])) . '/' . $deck[0] . '.php')) {
                    $deckPageCopy = 'deckPage.php';
                    $newDeckPage = strtolower(preg_replace('/\s*/', '', $deck[1])) . '/' . $deck[0] . '.php';

                    copy($deckPageCopy, $newDeckPage);
                }
            }
            ////////////////////////////////////////////////////////////////////
            ?>

            <!--
            //show all////////////////////////////////////////////////////////
            // $previousBrand = '';
            // $currentBrand = '';
            // $query = 'SELECT fldBoardName,pmkBoard,fldBrand
            //     FROM tblBoards
            //     ORDER BY fldBrand,pmkBoard ASC';
            // $decks = $thisDatabaseReader->select($query, "", 0, 1, 0, 0, false, false);
            // $currentBrand = $decks[0][2]
            //
            // foreach ($decks as $deck) {
            //         $currentBrand = $deck[2];
            //         if (!$currentBrand == $previousBrand) {
            //             //close previous container
            //             //show logo
            //             //start decks box
            //         }
            //         //show decks
            //         $previousBrand = $currentBrand;
            //     }
            // }
             -->
            <div class="skinny">
                <h4><a href="searchForm.php">SEARCH</a></h4>
                <h1 class="borderBottom">Deck Database</h1>
            </div>
            <!--
            <div class="jumpToDeck">
                <h3>Jump to a Brand:</h3>
                <table>
                    <tr>
                        <td><a href="#arbor">Arbor</a></td>
                        <td><a href="#bustin">Bustin</a></td>
                        <td><a href="#clutch">Clutch</a></td>
                        <td><a href="#landyachtz">Landyachtz</a></td>
                    </tr>
                    <tr>
                        <td><a href="#loaded">Loaded</a></td>
                        <td><a href="#moonshine">Moonshine</a></td>
                        <td><a href="#omen">Omen</a></td>
                        <td><a href="#original">Original</a></td>
                    </tr>
                    <tr>
                        <td><a href="#pantheon">Pantheon</a></td>
                        <td><a href="#rayne">Rayne</a></td>
                        <td><a href="#remember">Remember</a></td>
                        <td><a href="#sector9">Sector 9</a></td>
                    </tr>
                </table>
            </div>
            -->

            <div class="logoborder"><img id="arbor" src="logos/arbor.png" class="logo" alt="The Arbor Collective"></div>
            <div class="decks">
                <?php
                $brandName = "arbor";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Arbor"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {
                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $image->setImageCompression(\Imagick::COMPRESSION_UNDEFINED);
                        $image->setImageCompressionQuality(0);
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>

            <?php
            // $brandName = "arbor";
            // $query = 'SELECT pmkBoard,fldBoardName,fldBrand
            //     FROM tblBoards
            //     WHERE fldBrand = "Arbor"
            //     ORDER BY fldBoardName ASC';
            //
            // $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);
            //
            // $decks1 = array();
            // foreach ($decks as $deck) {
            //     $arr = array("pmkBoard" => $deck[0], "fldBoardName" => $deck[1], "fldBrand" => str_replace(' ', '', strtolower($deck[2])));
            //     array_push($decks1, $arr);
            // }
            //
            // //convert array to json for
            // $jsonString = json_encode($decks1);
            // ?>
            <!-- // <test-element deck-list='<?php echo $jsonString ?>'>
            // </test-element> -->

            <?php
            /*
              if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
              $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
              $image->thumbnailImage(0, round($deck[2] * 10));
              $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
              $image->writeImage($newFileName);
              $image->destroy();
              }

              print'<div class="gallery">';
              print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
              print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
              print'<h3>' . $deck[1] . '</h3>';
              print'</div>';
             *
             */
            ?>


            <div class="logoborder"><img id="bustin" src="logos/bustin.png" class="logo" alt="Bustin"></div>

            <div class="decks">
                <?php
                $brandName = "bustin";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Bustin"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {
                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>

            <div class="logoborder"><img id="clutch" src="logos/clutch.png" class="logo" alt="Clutch"></div>


            <div class="decks">
                <?php
                $brandName = "clutch";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Clutch"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {
                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>


            <div class="logoborder"><img id="comet" src="logos/comet.png" class="logo" alt="Comet"></div>

            <div class="decks">
                <?php
                $brandName = "comet";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Comet"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {
                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>

            <div class="logoborder"><img id="loaded" src="logos/loaded.png" class="logo" alt="Loaded"></div>

            <div class="decks">
                <?php
                $brandName = "loaded";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Loaded"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {
                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>
            <!--
            <img id="madrid" src="logos/madrid.png" class="logo" alt="Madrid">
            -->
            <div class="logoborder"><img id="moonshine" src="logos/moonshine.png" class="logo" alt="Moonshine MFG"></div>
            <div class="decks">
                <?php
                $brandName = "moonshinemfg";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Moonshine MFG"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {
                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>
            <!--
            <img id="nelson" src="logos/nelson.png" class="logo" alt="Nelson">


            <div class="gallery">
                <a href="nelson/batray.php"></a>
                <div><img src="images/batray.png" alt="Nelson Batray 4.8" height="385"></div>
                <h3>Batray 4.8</h3>
            </div>
            -->

            <div class="logoborder"><img id="omen" src="logos/omen.png" class="logo" alt="Omen"></div>

            <div class="decks">
                <?php
                $brandName = "omen";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Omen"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {
                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>

            <div class="logoborder"><img id="original" src="logos/original.png" class="logo" alt="Original"></div>

            <div class="decks">
                <?php
                $function = 'this.src="missingDeck.png";';
                $brandName = "original";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Original"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {
                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>

            <div class="logoborder"><img id="pantheon" src="logos/pantheon.png" class="logo" alt="Pantheon"></div>

            <div class="decks">
                <?php
                $brandName = "pantheon";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Pantheon"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {
                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>

            <div class="logoborder"><img id="rayne" src="logos/rayne.png" class="logo" alt="Rayne"></div>

            <div class="decks">
                <?php
                $brandName = "rayne";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Rayne"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {

                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" height="' . round($deck[2] * 10) . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>

            <div class="logoborder"><img id="valhalla" src="logos/valhalla.png" class="logo" alt="Valhalla"></div>

            <div class="decks">
                <?php
                $brandName = "valhalla";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Valhalla"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {

                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" height="' . round($deck[2] * 10) . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>

            <div class="logoborder"><img id="madrid" src="logos/madrid.png" class="logo" alt="Madrid"></div>

            <div class="decks">
                <?php
                $brandName = "madrid";
                $query = 'SELECT pmkBoard,fldBoardName,fldLength
                FROM tblBoards
                WHERE fldBrand = "Madrid"
                ORDER BY fldBoardName ASC';

                $decks = $thisDatabaseReader->select($query, "", 1, 1, 2, 0, false, false);

                foreach ($decks as $deck) {

                    if (!file_exists($brandName . '/thumbs/' . $deck[0] . 'Thumb.png')) {
                        $image = new Imagick($brandName . '/images/' . $deck[0] . '.png');
                        $image->thumbnailImage(0, round($deck[2] * 10));
                        $newFileName = $brandName . '/thumbs/' . $deck[0] . 'Thumb.png';
                        $image->writeImage($newFileName);
                        $image->destroy();
                    }

                    print'<div class="gallery">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" height="' . round($deck[2] * 10) . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                ?>
            </div>

<?php include('footer.php'); ?>
        </div>
    </body>

</html>
