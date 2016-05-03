<!DOCTYPE HTML>
<html lang="en">
    <?php include ('../deckTop.php'); ?>
    <body id = "deckPage">
        <header><h1>LONGBOARD BASE</h1></header>
        <?php include ('../nav.php'); ?>
        <div class="background">
            <?php
            $boardEditName = $path_parts['filename'];
            $boardName = chop($boardEditName, "Edit");
            $query = 'SELECT fldBrand,pmkBoard,fldBoardName,fldLength,fldWidth,fldMinWhlBase,fldMaxWhlBase,fldShape,fldConstruction,fldVideo
                FROM tblBoards
                WHERE pmkBoard = "' . $boardName . '"';

            $deckInfo = $thisDatabaseReader->select($query, "", 1, 0, 2, 0, false, false);

            foreach ($deckInfo as $info) {

                $deckName = $info[2];
                $brand = $info[0];
                $deckLength = $info[3];
                $deckWidth = $info[4];
                $deckWBMin = $info[5];
                $deckWBMax = $info[6];
                $videoSource = $info[9];
                $deckKey = $info[1];
                $deckShape = $info[7];
                $deckConstruction = $info[8];

                $dataRecord = array();


                if (isset($_POST["btnSubmit"])) {

                    $brand = htmlentities($_POST["lstBrand"], ENT_QUOTES, "UTF-8");
                    $dataRecord[] = $brand;

                    $deckName = htmlentities($_POST["txtDeckName"], ENT_QUOTES, "UTF-8");
                    $dataRecord[] = $deckName;

                    $deckLength = htmlentities($_POST["txtDeckLength"], ENT_QUOTES, "UTF-8");
                    $dataRecord[] = $deckLength;

                    $deckWidth = htmlentities($_POST["txtDeckWidth"], ENT_QUOTES, "UTF-8");
                    $dataRecord[] = $deckWidth;

                    $deckWBMin = htmlentities($_POST["txtDeckWBMin"], ENT_QUOTES, "UTF-8");
                    $dataRecord[] = $deckWBMin;

                    $deckWBMax = htmlentities($_POST["txtDeckWBMax"], ENT_QUOTES, "UTF-8");
                    $dataRecord[] = $deckWBMax;

                    $deckShape = htmlentities($_POST["txtDeckShape"], ENT_QUOTES, "UTF-8");
                    $dataRecord[] = $deckShape;

                    $deckConstruction = htmlentities($_POST["txtDeckConstruction"], ENT_QUOTES, "UTF-8");
                    $dataRecord[] = $deckConstruction;

                    $videoSource = htmlentities($_POST["txtVideoSource"], ENT_QUOTES, "UTF-8");
                    $dataRecord[] = $videoSource;

                    $dataRecord[] = $boardName;


                    $query = 'UPDATE tblNewBoards SET ';

                    $query .= 'fldBrand = ?, ';
                    $query .= 'fldBoardName = ?, ';
                    $query .= 'fldLength = ?, ';
                    $query .= 'fldWidth = ?, ';
                    $query .= 'fldMinWhlBase = ?, ';
                    $query .= 'fldMaxWhlBase = ?, ';
                    $query .= 'fldShape = ?, ';
                    $query .= 'fldConstruction = ?, ';
                    $query .= 'fldVideo = ?, ';
                    $query .= 'WHERE pmkBoard = ?';

                    $results = $thisDatabase->update($query, $data, 1, 0, 0, 0, false, false);
                }
                ?>

                <h1 class="borderBottom">Edit a Deck</h1>
                <?php
                //####################################
                //
                // SECTION 3a.
                //
                // 
                // 
                // 
                // If its the first time coming to the form or there are errors we are going
                // to display the form.
                if (isset($_POST["btnSubmit"])) {
                    print "<h1>Your Request has ";
                    print "been processed</h1>";
                } else {
                    ?>
                    <form action = "<?php print $phpSelf; ?>"
                          method = "post"
                          id = "frmEdit">
                        <fieldset class = "contact">
                            <legend>Deck information</legend>
                            <label for = "lstBrand" class = "required">Select a brand</label>
                            <select id = "lstBrand"
                                    name = "lstBrand"
                                    tabindex = "12" >
                                        <?php
                                        $myFileName = "brands";
                                        $fileExt = ".csv";
                                        $filename = $myFileName . $fileExt;
                                        $file = fopen($filename, "r");
                                        /* the variable $file will be empty or false if the file does not open */
                                        if ($file) {
                                            while (!feof($file)) {
                                                $brandList[] = fgetcsv($file);
                                            }
                                            fclose($file);
                                        } // ends if file was opened
                                        foreach ($brandList as $item) {
                                            print'<option value="' . $item[0] . '">' . $item[0] . '</option>';
                                        }
                                        ?>
                            </select>
                            <label for="txtDeckName" class="required">Deck Name</label>
                            <input type="text" id="txtDeckName" name="txtDeckName"
                                   value="<?php print $deckName; ?>"
                                   tabindex="130" maxlength="45" placeholder="Enter the deck's name"
                                   <?php if ($deckNameERROR) print 'class="mistake"'; ?>
                                   >
                            <label for="txtDeckLength" class="required">Deck Length</label>
                            <input type="text" id="txtDeckLength" name="txtDeckLength"
                                   value="<?php print $deckLength; ?>"
                                   tabindex="132" maxlength="10" placeholder="Enter the deck's length"
                                   <?php if ($deckLengthERROR) print 'class="mistake"'; ?>
                                   >
                            <label for="txtDeckWidth" class="required">Deck Width</label>
                            <input type="text" id="txtDeckWidth" name="txtDeckWidth"
                                   value="<?php print $deckWidth; ?>"
                                   tabindex="133" maxlength="10" placeholder="Enter the deck's width"
                                   <?php if ($deckWidthERROR) print 'class="mistake"'; ?>
                                   >
                            <label for="txtDeckWBMin" class="required">Minimum Wheelbase</label>
                            <input type="text" id="txtDeckWBMin" name="txtDeckWBMin"
                                   value="<?php print $deckWBMin; ?>"
                                   tabindex="134" maxlength="10" placeholder="Enter the minimum wheelbase"
                                   <?php if ($deckWBMinERROR) print 'class="mistake"'; ?>
                                   >
                            <label for="txtDeckWBMax" class="required">Maximum Wheelbase</label>
                            <input type="text" id="txtDeckWBMax" name="txtDeckWBMax"
                                   value="<?php print $deckWBMax; ?>"
                                   tabindex="135" maxlength="10" placeholder="Enter the maximum wheelbase"
                                   <?php if ($deckWBMaxERROR) print 'class="mistake"'; ?>
                                   >
                            <label for="txtDeckShape" class="required">Deck Shape</label>
                            <input type="text" id="txtDeckShape" name="txtDeckShape"
                                   value="<?php print $deckShape; ?>"
                                   tabindex="136" maxlength="50" placeholder="Enter the deck shape"
                                   <?php if ($deckShapeERROR) print 'class="mistake"'; ?>
                                   >
                            <label for="txtDeckConstruction" class="required">Deck Construction</label>
                            <input type="text" id="txtDeckConstruction" name="txtDeckConstruction"
                                   value="<?php print $deckConstruction; ?>"
                                   tabindex="137" maxlength="50" placeholder="Enter the deck's construction"
                                   <?php if ($deckConstructionERROR) print 'class="mistake"'; ?>
                                   >
                            <label for="txtVideoSource" class="required">Video Embed Code</label>
                            <input type="text" id="txtVideoSource" name="txtVideoSource"
                                   value="<?php print $videoSource; ?>"
                                   tabindex="138" maxlength="200" placeholder="Enter the embed code for a video"
                                   <?php if ($videoSourceERROR) print 'class="mistake"'; ?>
                                   >
                        </fieldset>
                        <fieldset class="buttons">
                            <legend></legend>
                            <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" tabindex="900" class="button">
                        </fieldset> <!-- ends buttons -->
                    </form>
                    <?php
                }
            }
            ?>
            <?php include('../footer.php'); ?>
        </div>
    </body>
</html>