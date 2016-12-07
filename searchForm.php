<!DOCTYPE HTML>
<html lang="en">
    <?php include ('top.php'); ?>
    <body id="search">
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
            $shape = "";

            $lengthRangeString = "";
            $lengthRange = array();
            $lengthMin = "";
            $lengthMax = "";
            $widthRangeString = "";
            $widthRange = array();
            $widthMin = "";
            $widthMax = "";
            $wbRangeString = "";
            $wbRange = array();
            $wbMin = "";
            $wbMax = "";


            //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
            //
            // SECTION: 1d form error flags
            //
            // Initialize Error Flags one for each form element we validate
            // in the order they appear in section 1c.


            $deckNameERROR = false;
            $deckLengthERROR = false;
            $deckWidthError = false;
            $deckWBMinERROR = false;
            $deckWBMaxERROR = false;



            //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
            //
            // SECTION: 1e misc variables
            //
            // create array to hold error messages filled (if any) in 2d displayed in 3c.
            $errorMsg = array();


            //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            //
            // SECTION: 2 Process for when the form is submitted
            //
            if (isset($_POST["btnSearch"])) {

                //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                //
                // SECTION: 2b Sanitize (clean) data
                // remove any potential JavaScript or html code from users input on the
                // form. Note it is best to follow the same order as declared in section 1c.

                $brand = htmlentities($_POST["lstBrand"], ENT_QUOTES, "UTF-8");

                $shape = htmlentities($_POST["lstShape"], ENT_QUOTES, "UTF-8");

                $lengthRangeString = htmlentities($_POST["lengthRange"], ENT_QUOTES, "UTF-8");
                preg_match_all('!\d+!', $lengthRangeString, $lengthRangeArray);
                $lengthRange = $lengthRangeArray[0];
                $lengthMin = $lengthRange[0];
                $lengthMax = $lengthRange[1];

                $widthRangeString = htmlentities($_POST["widthRange"], ENT_QUOTES, "UTF-8");
                preg_match_all('!\d+(?:\.\d+)?!', $widthRangeString, $matches);
                $floats = array_map('floatval', $matches[0]);
                $widthMin = $floats[0];
                $widthMax = $floats[1];


                $wbRangeString = htmlentities($_POST["wheelbaseRange"], ENT_QUOTES, "UTF-8");
                preg_match_all('!\d+!', $wbRangeString, $wbRangeArray);
                $wbRange = $wbRangeArray[0];
                $wbMin = $wbRange[0];
                $wbMax = $wbRange[1];


                $deckName = htmlentities($_POST["txtDeckName"], ENT_QUOTES, "UTF-8");

                $deckLength = htmlentities($_POST["txtDeckLength"], ENT_QUOTES, "UTF-8");

                $deckWidth = htmlentities($_POST["txtDeckWidth"], ENT_QUOTES, "UTF-8");

                $deckWBMin = htmlentities($_POST["txtDeckWBMin"], ENT_QUOTES, "UTF-8");

                $deckWBMax = htmlentities($_POST["txtDeckWBMax"], ENT_QUOTES, "UTF-8");

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
                //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                //
                // SECTION: 2d Process Form - Passed Validation
                //
                // Process for when the form passes validation (the errorMsg array is empty)
                //
                if (!$errorMsg) {
                    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                    //
                    // SECTION: 2e Save Data
                    $query = 'SELECT pmkBoard,fldBoardName,fldLength,fldBrand
                    FROM tblBoards
                    WHERE (fldLength BETWEEN "'.$lengthMin.'" AND "'.$lengthMax.'")
                    AND (fldWidth BETWEEN "'.$widthMin.'" AND "'.$widthMax.'")
                    AND (fldMinWhlBase <= "'.$wbMax.'")
                    AND (fldMaxWhlBase >= "'.$wbMin.'")';
                    $whereCount = 1;
                    $quoteCount = 12;
                    $conditionCount = 5;
                    $symbolCount = 2;
                    if ($brand != "Any") {
                        $query .= ' AND fldBrand = "'.$brand.'"';
                        $conditionCount += 1;
                        $quoteCount += 2;
                    }
                    if ($shape != "Any") {
                        $query .= ' AND fldShape = "'.$shape.'"';
                        $conditionCount += 1;
                        $quoteCount += 2;
                    }
                    if ($deckName != "") {
                        $query .= ' AND fldBoardName LIKE "%'.$deckName.'%"';
                        $quoteCount += 2;
                        $conditionCount += 1;
                    }

                    $results = $thisDatabaseReader->select($query, "", $whereCount, $conditionCount, $quoteCount, $symbolCount, false, false);

                } // end form is valid
            } // ends if form was submitted.
            //#############################################################################
            //
            // SECTION 3 Display Form
            //
            ?>
            <h1 class="borderBottom">Deck Search</h1>
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
            if (isset($_POST["btnSearch"]) AND empty($errorMsg)) { // closing of if marked with: end body submit

                // print $query;

                print'<div class="decks grid">';
                foreach ($results as $deck) {
                    $brandName = strtolower(preg_replace('/\s*/', '', $deck[3]));
                    print'<div class="gallery ">';
                    print'<a href="' . $brandName . '/' . $deck[0] . '.php"></a>';
                    print'<div><img src="' . $brandName . '/thumbs/' . $deck[0] . 'Thumb.png" alt="' . $deck[1] . '" /></div>';
                    print'<h3>' . $deck[1] . '</h3>';
                    print'</div>';
                }
                print'</div>';
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
                          id="frmSearch">
                        <h4>Leave any categories blank that you would not like to specify</h4>

                            <fieldset class="search">
                                <label for="lstBrand" class="required">Select a brand</label>
                                <select id="lstBrand"
                                        name="lstBrand"
                                        tabindex="12" >
                                <option value="Any">Any</option>
                    <?php
                    $brandQuery = 'SELECT DISTINCT fldBrand
                    FROM tblBoards
                    ORDER BY fldBrand ASC';

                    $brandList = $thisDatabaseReader->select($brandQuery, "", 0, 1, 0, 0, false, false);

                    foreach ($brandList as $item) {
                        print'<option value="' . $item[0] . '">' . $item[0] . '</option>';
                    }
                    ?>
                                </select>
                                <label for="lstShape" class="required">Select a shape</label>
                                <select id="lstShape"
                                        name="lstShape"
                                        tabindex="13" >
                                <option value="Any">Any</option>
                                <?php
                    $brandQuery = 'SELECT DISTINCT fldShape
                    FROM tblBoards
                    ORDER BY fldShape ASC';

                    $brandList = $thisDatabaseReader->select($brandQuery, "", 0, 1, 0, 0, false, false);

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
                                <?php include ('lengthSlider.php'); ?>


                                <input type="submit" id="btnSearch" name="btnSearch" value="Search" tabindex="900" class="button">
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
<!--  Script for masonry layout  -->
<script>
var elem = document.querySelector('.decks');
var msnry = new Masonry( elem, {
  // options
  itemSelector: '.gallery',
  columnWidth: '.gallery',
  fitWidth: true,
  gutter: 10,
  stagger: '0.03s',
  // slow transitions
  transitionDuration: '0.7s'
});
imagesLoaded( elem ).on( 'progress', function() {
  // layout Masonry after each image loads
  msnry.layout();
});
msnry.on( 'layoutComplete', function( laidOutItems ) {
    console.log('Complete');
});

// Wait until all images load to generate masonry layout

// var grid = document.querySelector('.decks');
// var msnry;
//
// imagesLoaded( grid, function() {
//   // init Isotope after all images have loaded
//   msnry = new Masonry( grid, {
//     itemSelector: '.gallery',
//     columnWidth: '.gallery',
//     fitWidth: true,
//     gutter: 10
//   });
// });
</script>
