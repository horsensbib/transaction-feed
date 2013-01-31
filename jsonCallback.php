<script src="http://code.jquery.com/jquery-latest.js"></script>

<script>
//Jsonp call to get items
(function($) {
var url = 'http://10.10.1.91/feed/jsonafl.php?callback=?';

$.ajax({
   type: 'GET',
    url: url,
    jsonpCallback: 'jsonCallback',
    contentType: "application/json",
    dataType: 'jsonp',
    success: function(json) {
        $(document).ready(function() {
            var res = 'http://localhost/feed/getImage.php?faust='.concat(json.item[0].faustno);
       			$("#image").attr("src",res);
       			$("#image").hide();
       			jQuery('#image').bind('load',function(){
       	         $("#image").show();
       	});
        })
    },
    error: function(e) {
       console.log(e.message);
    }
});
})(jQuery);
</script>
<image id="image"></image>
