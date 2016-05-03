<!DOCTYPE HTML>
<html lang="en">
    <?php include ('top.php'); ?>
    <body id="submitAdeck">
        <header><h1>LONGBOARD BASE</h1></header>
        <?php include ('nav.php'); ?>
        <div class="background">
            <?php
            //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
            //
            // SECTION: 1 Initialize variables
            //
            // SECTION: 1a.
            // variables for the classroom purposes to help find errors.

            $debug = false;

            if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
                $debug = true;
            }

            if ($debug) {
                print "<p>DEBUG MODE IS ON</p>";
            }
            //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
            //
            // SECTION: 1b Security
            //
            // define security variable to be used in SECTION 2a.
            $yourURL = $domain . $phpSelf;


            //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
            //
            // SECTION: 1c form variables
            //
            // Initialize variables one for each form element
            // in the order they appear on the form

            
            $deckName = "";
            $brand = "";
            $imageSource = "";

            $deckLength = "";
            $deckWidth = "";
            $deckWBMin = "";
            $deckWBMax = "";
            $videoSource = "";
            $deckKey = "";
            $deckShape = "";
            $deckConstruction = "";


            //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
            //
            // SECTION: 1d form error flags
            //
            // Initialize Error Flags one for each form element we validate
            // in the order they appear in section 1c.

            $deckNameERROR = false;
            $deckKeyERROR = false;
            $deckLengthERROR = false;
            $deckWidthError = false;
            $deckWBMinERROR = false;
            $deckWBMaxERROR = false;
            $deckShapeERROR = false;
            $videoSourceERROR = false;
            $deckConstructionERROR = false;
            $imageSourceERROR = false;


            //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
            //
            // SECTION: 1e misc variables
            //
            // create array to hold error messages filled (if any) in 2d displayed in 3c.
            $errorMsg = array();

            // array used to hold form values that will be written to a CSV file
            $dataRecord = array();
            
            //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            //
            // SECTION: 2 Process for when the form is submitted
            //
            if (isset($_POST["btnSubmit"])) {



                //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                //
            // SECTION: 2b Sanitize (clean) data 
                // remove any potential JavaScript or html code from users input on the
                // form. Note it is best to follow the same order as declared in section 1c.

                $brand = htmlentities($_POST["lstBrand"], ENT_QUOTES, "UTF-8");
                $dataRecord[] = $brand;

                $deckKey = htmlentities($_POST["txtDeckKey"], ENT_QUOTES, "UTF-8");
                $dataRecord[] = $deckKey;

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
                
                $imageSource = htmlentities($_POST["txtImageSource"], ENT_QUOTES, "UTF-8");
                $dataRecord[] = $imageSource;

                //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                //
                // SECTION: 2c Validation
                //
                // Validation section. Check each value for possible errors, empty or
                // not what we expect. You will need an IF block for each element you will
                // check (see above section 1c and 1d). The if blocks should also be in the
                // order that the elements appear on your form so that the error messages
                // will be in the order they appear. errorMsg will be displayed on the form
                // see section 3b. The error flag ($emailERROR) will be used in section 3c.

                if ($deckName == "") {
                    $errorMsg[] = "Please enter the deck's name";
                    $deckNameERROR = true;
                } elseif (!verifyAlphaNum($deckName)) {
                    $errorMsg[] = "The name appears to have extra character.";
                    $deckNameERROR = true;
                }

                if ($deckKey == "") {
                    $errorMsg[] = "Please enter the deck's file name";
                    $deckKeyERROR = true;
                } elseif (!verifyAlphaNum($deckKey)) {
                    $errorMsg[] = "The name appears to have extra character.";
                    $deckKeyERROR = true;
                }

                if ($deckLength == "") {
                    $errorMsg[] = "Please enter the deck's length";
                    $deckLengthERROR = true;
                } elseif (!verifyNumeric($deckLength)) {
                    $errorMsg[] = "Only numbers are allowed.";
                    $deckLengthERROR = true;
                }

                if ($deckWidth == "") {
                    $errorMsg[] = "Please enter the deck's width";
                    $deckWidthERROR = true;
                } elseif (!verifyNumeric($deckWidth)) {
                    $errorMsg[] = "Only numbers are allowed.";
                    $deckWidthERROR = true;
                }

                if ($deckWBMin == "") {
                    $errorMsg[] = "Please enter the minimum wheelbase";
                    $deckWBMinERROR = true;
                } elseif (!verifyNumeric($deckWBMin)) {
                    $errorMsg[] = "Only numbers are allowed.";
                    $deckWBMinERROR = true;
                }

                if ($deckWBMax == "") {
                    $errorMsg[] = "Please enter the maximum wheelbase";
                    $deckWBMaxERROR = true;
                } elseif (!verifyNumeric($deckWBMax)) {
                    $errorMsg[] = "Only numbers are allowed.";
                    $deckWBMaxERROR = true;
                }

                if ($deckShape == "") {
                    $errorMsg[] = "Please enter the shape of the deck";
                    $deckShapeERROR = true;
                }

                if ($deckConstruction == "") {
                    $errorMsg[] = "Please enter the deck's construction";
                    $deckConstructionERROR = true;
                }
          //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                //
            // SECTION: 2d Process Form - Passed Validation
                //
            // Process for when the form passes validation (the errorMsg array is empty)
                //
            if (!$errorMsg) {
                    if ($debug) {
                        print "<p>Form is valid</p>";
                    }
                    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                    //
            // SECTION: 2e Save Data

                    $query = 'INSERT INTO tblNewBoards SET ';

                    $query .= 'fldBrand = ?, ';
                    $query .= 'pmkBoard = ?, ';
                    $query .= 'fldBoardName = ?, ';
                    $query .= 'fldLength = ?, ';
                    $query .= 'fldWidth = ?, ';
                    $query .= 'fldMinWhlBase = ?, ';
                    $query .= 'fldMaxWhlBase = ?, ';
                    $query .= 'fldShape = ?, ';
                    $query .= 'fldConstruction = ?, ';
                    $query .= 'fldVideo = ?, ';
                    $query .= 'fldImageSource = ?, ';
                    $query .= 'fldCurrent = ?, ';
                    $query .= 'fldLimited = ?, ';
                    $query .= 'fldDiscontinued = ?, ';
                    $query .= 'fnkEmail = ?';

                    $results = $thisDatabaseWriter->insert($query, $dataRecord);

                    // This block saves the data to a CSV file.

                    $fileExt = ".csv";

                    $myFileName = "data/registration";

                    $filename = $myFileName . $fileExt;

                    if ($debug) {
                        print "\n\n<p>filename is " . $filename;
                    }
                    // now we just open the file for append
                    $file = fopen($filename, 'a');

                    fputcsv($file, $dataRecord);

                    // close the file
                    fclose($file);

                    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@


                    //create new page for new deck info to be displayed
                    $deckPageCopy = 'newDeckPage.php';
                    $newDeckPage = 'temp/' . $deckKey . '.php';

                    copy($deckPageCopy, $newDeckPage);
                } // end form is valid
            } // ends if form was submitted.
            //#############################################################################
            //
            // SECTION 3 Display Form
            //
                        ?>
            <h1 class="borderBottom">Submit a Deck</h1>
            <article>
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
                if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
                    
                    //Image Upload
                    $target_dir = "temp/images/";
                    $target_file = $target_dir . $deckKey . ".png";
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }

                    /*
                      // Check if file already exists
                      if (file_exists($target_file)) {
                      echo "Sorry, file already exists.";
                      $uploadOk = 0;
                      }
                     */
                    // Check file size
                    if ($_FILES["fileToUpload"]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    $allowedTypes = array(IMAGETYPE_PNG);
                    $detectedType = exif_imagetype($_FILES['fileToUpload']['tmp_name']);
                    

                    print "<h1>Your Request has ";
                    print "been processed</h1>";
                    
                    if (!in_array($detectedType, $allowedTypes)) {
                        echo "Sorry, only PNG files are allowed.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                        $placeholderImage = 'missingDeck.png';
                        $newImage = "temp/images/". $deckKey . ".png";
                        copy($placeholderImage, $newImage);
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                            $placeholderImage = 'missingDeck.png';
                            $newImage = "temp/images/". $deckKey . ".png";
                            copy($placeholderImage, $newImage);
                        }
                    }
                } else {
                    //####################################
                    //
                    // SECTION 3b Error Messages
                    //
                    // display any error messages before we print out the form

                    if ($errorMsg) {
                        print '<div id="errors">';
                        print "<ol>\n";
                        foreach ($errorMsg as $err) {
                            print "<li>" . $err . "</li>\n";
                        }
                        print "</ol>\n";
                        print '</div>';
                    }
                    //####################################
                    //
                    // SECTION 3c html Form
                    //
                    /* Display the HTML form. note that the action is to this same page. $phpSelf
                      is defined in top.php
                      NOTE the line:

                      value="<?php print $email; ?>

                      this makes the form sticky by displaying either the initial default value (line 35)
                      or the value they typed in (line 84)

                      NOTE this line:

                      <?php if($emailERROR) print 'class="mistake"'; ?>

                      this prints out a css class so that we can highlight the background etc. to
                      make it stand out that a mistake happened here.

                     */
                    ?>

                    <form action="<?php print $phpSelf; ?>" enctype="multipart/form-data"
                          method="post"
                          id="frmRegister"> <!-- email contact form -->
                        <p>If there is a deck that you feel I might have missed and you would like me to add it, feel free to fill out the form below.</p>
                        
                            <fieldset class="contact">
                                <legend>Deck information</legend>
                                <label for="lstBrand" class="required">Select a brand</label>
                                <select id="lstBrand"
                                        name="lstBrand"
                                        tabindex="12" >
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
                                <label for="txtDeckKey" class="required">Deck File Name</label>
                                <input type="text" id="txtDeckKey" name="txtDeckKey"
                                       value="<?php print $deckKey; ?>"
                                       tabindex="131" maxlength="45" placeholder="Enter a filename for the deck"
                                       <?php if ($deckKeyERROR) print 'class="mistake"'; ?>
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
                                <label for="fileToUpload" >Upload Image</label>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <label for="txtImageSource" >Image Source</label>
                                <input type="text" id="txtImageSource" name="txtImageSource"
                                       value="<?php print $imageSource; ?>"
                                       tabindex="140" maxlength="300" placeholder="Enter the Source URL"
                                       <?php if ($imageSourceERROR) print 'class="mistake"'; ?>
                                       >
                                <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" tabindex="900" class="button">
                            </fieldset>
                    </form>

                    <?php
                } // end body submit
                ?>
            </article>
            <?php include "footer.php"; ?>
        </div>
    </body>
</html>