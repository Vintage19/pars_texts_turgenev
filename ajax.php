<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>

    var fruits = [
        'http://evakuator-moskva.su/zao/kuntsevo/'];


    $( document ).ready(function() {


        fruits.forEach(function(value, currentIndex) {
            setTimeout(function() {
                $.post(
                    "post.php",
                    {
                        url: value
                    },
                    onAjaxSuccess
                );

                function onAjaxSuccess(data)
                {
                    // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
                    $('.res').append("<p>" + value + " - " + data + "</p>");
                }

            }, 10000*currentIndex);
        });



    });


</script>

<div class="res"></div>