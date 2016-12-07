<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>This should become something</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="import"  href="bower_components/polymer/polymer.html">
        <link rel="import" href="bower_components/iron-scroll-threshold.html">
    </head>
    <body>
    <dom-module id="test-element" initialCount="40" targetFramerate="40" delay="5">

        <template>
            <!-- scoped CSS for this element -->
            <style>
                .decks {
                    margin: 0px auto;
                    overflow: hidden;
                    max-width: 100%; 
                }
                div.gallery {
                    margin: 10px;
                    border: 2px solid #218ACC;
                    height: 520px;
                    width: 156px;
                    float: left;
                    text-align: center;
                    border-radius: 8px;
                    background-color: #A8CCFF;
                    position: relative;
                    overflow: hidden;
                }
                a {
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    top: 0;
                    left: 0;
                    text-decoration: none; /* Makes sure the link   doesn't get underlined */
                    z-index: 10; /* raises anchor tag above everything else in div */
                    background-color: white; /*workaround to make clickable in IE */
                    opacity: 0; /*workaround to make clickable in IE */
                }
                h3 {
                    font-weight: bold;
                    color: white;
                    display: inline-block;
                    font-size: 20px;
                    padding: 3px 0px;
                    border-top: 1px #218ACC solid;
                    border-bottom: 1px #218ACC solid;
                    background-color: #218ACC;
                    width: 100%;
                }
                img {
                    display: inline;
                    margin: 5px;
                    padding: 8px;
                }
                .gallery div {
                    height: 440px;
                    vertical-align: central;
                }
                .gallery:hover {
                    border: 2px solid #218ACC;
                    background-color: #D9E6FF; 
                }
                .selected {
                    background-color: black;
                }
            </style>
            <iron-scroll-threshold on-lower-threshold="loadMore" lower-threshold="1" id="threshold" fit></iron-scroll-threshold>
            <div class="decks" id="scroller">
                <input value="{{searchString::input}}">
                
                <template is="dom-repeat" id="decks" items="{{deckList}}" as="deck" filter="{{computeFilter(searchString)}}" scroll-target="document">
                    <div class="gallery">
                        <a href="{{deck.fldBrand}}/{{deck.pmkBoard}}.php"></a>
                        <div>
                            <!-- any children are rendered here -->
                            <img src="{{deck.fldBrand}}/thumbs/{{deck.pmkBoard}}Thumb.png" alt="{{deck.fldBoardName}}" />
                        </div>
                        <h3>{{deck.fldBoardName}}</h3>
                    </div>
                </template>

                <array-selector id="selector" items="{{deckList}}" selected="{{selected}}" multi toggle></array-selector>
            </div>
        </template>

        <script>
            // register a new element called proto-element
            Polymer({
                is: 'test-element',
                properties: {
                    brand: String,
                    deckName: String,
                    deckLength: Number,
                    deckList: Array
                },
                computeFilter: function(string) {
                    if (!string) {
                        // set filter to null to disable filtering
                        return null;

                    } else {
                        // return a filter function for the current search string
                        string = string.toLowerCase();
                        return function(deck) {
                            var boardName = deck.fldBoardName.toLowerCase();
                            //var last = employee.lastname.toLowerCase();
                            return (boardName.indexOf(string) != -1);
                        };
                    }
                },
                toggleSelection: function(e) {
                    var item = this.$.deckList.itemForElement(e.target);
                    this.$.selector.select(item);
                    item.className += " selected";
                },
                loadMoreData: function() {
                    // load async stuff. e.g. XHR
                    asyncStuff(function done() {
                        ironScrollTheshold.clearTriggers();
                    });
                },
                ready: function() {
                    this.$.threshold.scrollTarget = this.$.scroller;
                    for (n = 0; n < 20; n++) {
                        this.push('items', n);
                    }
                },
                loadMore: function() {
                    var scope = this;
                    setTimeout(function() {
                        for (var i = n; i < n + 10; i++) {
                            scope.push('items', i);
                        }
                        n = i;
                        scope.$.threshold.clearLower();
                    }, 1000);
                }
            });
        </script>

    </dom-module>
</body>
</html>
