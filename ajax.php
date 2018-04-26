<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>
    // array with texts
    var fruits = ['text', 'text2'];


    $( document ).ready(function() {


        fruits.forEach(function(value, currentIndex) {
            setTimeout(function() {
                $.post(
                    "post.php",
                    {
                        text: value
                    },
                    onAjaxSuccess
                );

                function onAjaxSuccess(data)
                {
                    // Here we get the data sent by the server and display them on the screen.
                    $('.res').append("<p>" + value + " - " + data + "</p>");
                }

            }, 10000*currentIndex);
        });



    });


</script>

<div class="res"></div>