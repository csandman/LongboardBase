<!-- modified version from https://jqueryui.com/slider/#range -->
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Slider - Range slider</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 20,
      max: 60,
      values: [ 20, 60 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.values[ 0 ] + '" - ' + ui.values[ 1 ] + '"' );
      }
    });
    $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
      '" - ' + $( "#slider-range" ).slider( "values", 1 ) + '"' );
  });
  $(function() {
    $( "#slider-range1" ).slider({
      range: true,
      min: 6,
      max: 12,
      step: 0.25,
      values: [ 6, 12 ],
      slide: function( event, ui ) {
        $( "#amount1" ).val( ui.values[ 0 ] + '" - ' + ui.values[ 1 ] + '"' );
      }
    });
    $( "#amount1" ).val( $( "#slider-range1" ).slider( "values", 0 ) +
      '" - ' + $( "#slider-range1" ).slider( "values", 1 ) + '"' );
  });
  $(function() {
    $( "#slider-range2" ).slider({
      range: true,
      min: 5,
      max: 50,
      values: [ 5, 50 ],
      slide: function( event, ui ) {
        $( "#amount2" ).val( ui.values[ 0 ] + '" - ' + ui.values[ 1 ] + '"' );
      }
    });
    $( "#amount2" ).val( $( "#slider-range2" ).slider( "values", 0 ) +
      '" - ' + $( "#slider-range2" ).slider( "values", 1 ) + '"' );
  });
  </script>
</head>
<body>
 
<p>
  <label for="amount">Length Range:</label>
  <input type="text" id="amount" name="lengthRange">
</p>
 
<div id="slider-range"></div>

<p>
  <label for="amount1">Width Range:</label>
  <input type="text" id="amount1" name="widthRange">
</p>
 
<div id="slider-range1"></div>

<p>
  <label for="amount2">Wheelbase Range:</label>
  <input type="text" id="amount2" name="wheelbaseRange">
</p>
 
<div id="slider-range2"></div>
 
 
</body>
</html>