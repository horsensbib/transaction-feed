$(document).ready(function(){
    function getAfl() {
        var url='http://bibfolk.horsens.dk/feed/jsonafl.php?callback=?';
        $.getJSON(url,function(json){

            //setup an array to buffer output
            var output = [];
            var opac = 'https://www.bibfolk.horsens.dk/sites/WWW/pub/search.html?doaction=showfull&data=keyno_list%3D';
            var opacExt = '+format%3Dfull';

            output.push('<ul>');
            //a for loop will perform faster when setup like this
            for (var i = 0, len = json.item.length; i < len; i++) {

               //instead of appending each result, add each to the buffer array
               output.push('<li>');
               output.push('<img src="getImage.php?faust=' + json.item[i].faustno + '" />');
               output.push('<strong><a href="'+ opac + json.item[i].faustno + opacExt +'">' + json.item[i].title + '</a></strong>');
               if (json.item[i].author.length >= 0) {
                output.push('<br />' + json.item[i].author );
               }
               output.push('</li>');
            }
            output.push('</ul>');

            //now select the #results element only once and append all the output at once, then slide it into view
            $(".aflevering").html(output.join('')).slideDown('slow');
        });
    }

    //set an interval to run the getAfl function (30,000 ms is 5 minutes), you can cancel the interval by calling clearInterval(timer);
    var timer = setInterval(getAfl, 15000);

    //run the getAfl function on document.ready
    getAfl();
    
    function getUdl() {
        var url='http://bibfolk.horsens.dk/feed/jsonudl.php?callback=?';
        $.getJSON(url,function(json){

            //setup an array to buffer output
            var output = [];
            var opac = 'https://www.bibfolk.horsens.dk/sites/WWW/pub/search.html?doaction=showfull&data=keyno_list%3D';
            var opacExt = '+format%3Dfull';

            output.push('<ul>');
            //a for loop will perform faster when setup like this
            for (var i = 0, len = json.item.length; i < len; i++) {

               //instead of appending each result, add each to the buffer array
               output.push('<li>');
               output.push('<img src="getImage.php?faust=' + json.item[i].faustno + '" />');
               output.push('<strong><a href="'+ opac + json.item[i].faustno + opacExt +'">' + json.item[i].title + '</a></strong>');
               if (json.item[i].author.length >= 0) {
                output.push('<br />' + json.item[i].author );
               }
               output.push('</li>');
            }
            output.push('</ul>');

            //now select the #results element only once and append all the output at once, then slide it into view
            $(".udlaan").html(output.join('')).slideDown('slow');
        });
    }

    //set an interval to run the getUdl function (30,000 ms is 5 minutes), you can cancel the interval by calling clearInterval(timer);
    var timer = setInterval(getUdl, 15000);

    //run the getUdl function on document.ready
    getUdl();

});