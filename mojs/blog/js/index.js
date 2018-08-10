(function ($) {
    $.fn.FeedEk = function (opt) {
        var def = $.extend({
            MaxCount: 5,
            ShowDesc: true,
            ShowPubDate: true,
            DescCharacterLimit: 0,
            TitleLinkTarget: "_blank",
            DateFormat: "",
            DateFormatLang:"en"
        }, opt);

        var id = $(this).attr("id"), i, s = "", dt;
        $("#" + id).empty();
        if (def.FeedUrl == undefined) return;
        $("#" + id).append('<img src="loader.gif" />');

        var YQLstr = 'SELECT channel.item FROM feednormalizer WHERE output="rss_2.0" AND url ="' + def.FeedUrl + '" LIMIT ' + def.MaxCount;

        $.ajax({
            url: "https://query.yahooapis.com/v1/public/yql?q=" + encodeURIComponent(YQLstr) + "&format=json&diagnostics=false&callback=?",
            dataType: "json",
            success: function (data) {
                $("#" + id).empty();
                if (!(data.query.results.rss instanceof Array)) {
                    data.query.results.rss = [data.query.results.rss];
                }
                $.each(data.query.results.rss, function (e, itm) {
                    s += '<li class="treadmill-unit"><div class="itemTitle"><a href="' + itm.channel.item.link + '" target="' + def.TitleLinkTarget + '" >' + itm.channel.item.title + '</a></div>';

                    if (def.ShowPubDate){
                        dt = new Date(itm.channel.item.pubDate);
                        s += '<div class="itemDate">';
                        if ($.trim(def.DateFormat).length > 0) {
                            try {
                                moment.lang(def.DateFormatLang);
                                s += moment(dt).format(def.DateFormat);
                            }
                            catch (e){s += dt.toLocaleDateString();}
                        }
                        else {
                            s += dt.toLocaleDateString();
                        }
                        s += '</div>';
                    }

                    if (def.ShowDesc) {
                        s += '<div class="itemContent">';
                         if (def.DescCharacterLimit > 0 && itm.channel.item.description.length > def.DescCharacterLimit) {
                            s += itm.channel.item.description.substring(0, def.DescCharacterLimit) + '...';
                        }
                        else {
                            s += itm.channel.item.description;
                         }
                         s += '</div>';
                    }
                });
                $("#" + id).append('<ul id="mytreadmill" class="treadmill feedEkList">' + s + '</ul>');
            }
        });
    };
})(jQuery);
// super-treadmill.js, version 1.0

// Cycle through HTML elements in a super awesome treadmill fashion

// Copyright (c) 2015 nishadmenezes
// project located at https://github.com/nishadmenezes/super-treadmill.
// Licenced under the MIT license (see LICENSE file)

(function ( $ ) {

    var running = false;

    // moves treadmill in the downward direction
    treadmillDown = function(obj, speed) {
                    setTimeout( function() {
                        if(running) {
                            var elm = obj.find('.treadmill-unit').last();
                            var elm2 = elm.clone();
                            var height = elm.height();
                            elm2.css('top', -height + 'px');
                            elm2.css('height', '0px');
                            elm2.prependTo(obj);
                            elm2.animate({
                                'top': '0px',
                                'height': height
                            }, 1000, function() {
                                elm.remove();
                            });

                            treadmillDown(obj, speed);
                        }
                    }, speed);
    },

    //moves treadmill in the upward direction
    treadmillUp = function(obj, speed) {
                    setTimeout( function() {
                        if(running) {
                            var elm = obj.find('.treadmill-unit').first();
                            var elm2 = elm.clone();
                            var height = elm.height();
                            elm.animate({
                                'height': '0px',
                                'top': -height
                            }, 1000, function() {
                                elm.remove();
                            });
                            elm2.appendTo(obj);

                            treadmillUp(obj, speed);
                        }
                    }, speed);
    },

    // decides which type of treadmill to use
    selectTreadmill = function(direction, obj, speed) {
        if(direction == "down")
            treadmillDown(obj, speed);
        else
            treadmillUp(obj, speed);
    },

    // starts the treadmill
    $.fn.startTreadmill = function( options ) {

        var treadmillHeight = 0;

        var settings = $.extend({
            // These are the defaults.
            runAfterPageLoad: true,
            direction: "down",
            speed: "medium",
            viewable: 3,
            pause: false
        }, options );

        // Sets the height of Super Treadmill to viewable times height of the first unit else it is set to user-defined css value
        if(settings.viewable <= $(this).children().length && settings.viewable != 0)
            treadmillHeight = settings.viewable * $(this).find('.treadmill-unit').first().height();
        else
            treadmillHeight = $(this).height();

        $(this).css('height', treadmillHeight);


        // Super-Treadmill starts immediately after the page load
        if(settings.runAfterPageLoad)
            running = true;


        // Setting the tread speed of the Super-Treadmill
        var treadSpeed = 3000;

        if(settings.speed == "slow" || settings.speed == "medium" || settings.speed == "fast" || $.isNumeric(settings.speed)) {
            if(settings.speed == "slow")
                treadSpeed = 5000; // 5 seconds
            else if(settings.speed == "fast")
                treadSpeed = 1200; // 1.2 seconds
            else if(settings.speed == "medium")
                treadSpeed = 10000; // 3 seconds
            else
                treadSpeed = settings.speed; // user-defined value
        }
        else
            $.error("Super-Treadmill can only use one of its predefined speeds: 'slow', 'medium', 'fast' or a number that you specify, which it later converts into milliseconds");


        // Binding events to pause the Super-Treadmill during mouse enter and leave.
        if(settings.pause) {
            $(this).mouseenter( function() {
                running = !running;
            });

            $(this).mouseleave( function() {
                running = !running;
                selectTreadmill(settings.direction, $(this), treadSpeed);
            });
        }

        selectTreadmill(settings.direction, $(this), treadSpeed);

    };

}( jQuery ));

function getFeed () {

$('#divRss').FeedEk({
      // FeedUrl : 'http://feeds.feedburner.com/TechCrunch/', // TECHCRUNCH //
      FeedUrl : 'http://rss.news.yahoo.com/rss/topstories', // YAHOO NEWS //
      // FeedUrl : 'https://api.foxsports.com/v1/rss?partnerKey=zBaFxRyGKCfxBagJG9b8pqLyndmvo7UU', // FOX SPORTS //
      // FeedUrl : 'http://rss.cnn.com/rss/cnn_topstories.rss', // CNN TOP STORIES //
      // FeedUrl : 'https://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml', // NEW YORK TIMES //
      // FeedUrl : 'http://espn.go.com/espn/rss/news', // ESPN //
      // FeedUrl : 'https://feeds.wired.com/wired/index', // WIRED //
      // FeedUrl : 'http://www.cnet.com/rss/news/', // CNET //
      // FeedUrl : 'https://feeds.bbci.co.uk/news/world/rss.xml', // BBC //
      // FeedUrl : 'http://feeds.feedburner.com/DiscoverTopStories', // DISCOVER MAGAZINE //
      // FeedUrl : 'http://feeds.pcmag.com/Rss.aspx/SectionArticles?sectionId=1475', // PC MAGAZINE //

      MaxCount : 15,
      // ShowDesc : true,
      // ShowPubDate:true,
      // DescCharacterLimit:100,
      // TitleLinkTarget:'_blank',
      DateFormat: 'MM/DD/YYYY',
      DateFormatLang: 'en'
});
  
}

$(document).ready(function() {
      getFeed();
      // setInterval(getFeed, 20000);
      setTimeout(function() {
             $('#mytreadmill').startTreadmill({ direction: "up", viewable: 10});
    }, 4000);
});