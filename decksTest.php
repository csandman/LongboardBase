<!DOCTYPE HTML>
<html lang="en">
    <?php include ('top.php'); ?>
    <body id="decksBody">
        <header><h1>LONGBOARD BASE</h1></header>
        <?php include ('nav.php'); ?>
        <p class="print">This page does not print well.</p>
        <div class="background">
            <div class="skinny">
                <h4><a href="searchForm.php">SEARCH</a></h4>
                <h1 class="borderBottom">Deck Database</h1>
            </div><?php
            $query = 'SELECT pmkBoard,fldBoardName,fldBrand
                FROM tblBoards
                ORDER BY fldBoardName ASC';

            $decks = $thisDatabaseReader->select($query, "", 0, 1, 0, 0, false, false);

            $decks1 = array();
            foreach ($decks as $deck) {
                $arr = array("pmkBoard" => $deck[0], "fldBoardName" => $deck[1], "fldBrand" => str_replace(' ', '', strtolower($deck[2])));
                array_push($decks1, $arr);
            }

            //convert array to json for 
            $jsonString = json_encode($decks1);
            ?>

            <flip-card>
                <front>                
                    <div class="gallery">
                        <a href="arbor/agent.php"></a>
                        <div>
                            <!-- any children are rendered here -->
                            <img src="arbor/thumbs/agentThumb.png" alt="Agent" />

                        </div>
                        <h3>Agent</h3>
                    </div>
                </front>
                <back>               
                    <div class="gallery">
                        <a href="arbor/agent.php"></a>
                        <div>
                        <ul>
                            <li>Length: 30"</li>
                            <li>Width: 9"</li>
                            <li>Shape: Top Mount</li>
                        </ul>
                        </div>
                        <h3>Agent</h3>
                    </div>
                </back>
            </flip-card>

            <test-element deck-list='<?php echo $jsonString ?>'>
            </test-element>
            
            <?php include('footer.php'); ?>
        </div>
    </body>
</html>