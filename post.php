<?php
require('phpQuery/phpQuery.php');

function get_o ($text) {


    $curl = curl_init(); //инициализация сеанса
    curl_setopt($curl, CURLOPT_URL, 'https://turgenev.ashmanov.com/'); //урл сайта к которому обращаемся
    curl_setopt($curl, CURLOPT_HEADER, 1); //выводим заголовки
    curl_setopt($curl, CURLOPT_POST, 1); //передача данных методом POST
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //теперь curl вернет нам ответ, а не выведет
    curl_setopt($curl, CURLOPT_POSTFIELDS,
        array(
            'email' => '777goldenfish@gmail.com',
            'password' => 'glodiator1990'
        ));
    curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 5');
    curl_setopt($curl, CURLOPT_REFERER, "http://ya.ru");
    curl_setopt($ch, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT'] . '/cookie.txt');
    $res = curl_exec($curl);
    if (!$res) {
        $error = curl_error($curl) . '(' . curl_errno($curl) . ')';
        echo $error;
    } else {

        $res = stristr($res, 'Set-Cookie: ');
        $res = stristr($res, '; path=/;', true);
        $res = str_replace('Set-Cookie: usess=', '', $res);
    }
    curl_close($curl);


    $curl = curl_init(); //инициализация сеанса
    curl_setopt($curl, CURLOPT_URL, 'https://turgenev.ashmanov.com/'); //урл сайта к которому обращаемся
    curl_setopt($curl, CURLOPT_HEADER, 1); //выводим заголовки
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Cookie: usess=" . $res));
    curl_setopt($curl, CURLOPT_POST, 1); //передача данных методом POST
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //теперь curl вернет нам ответ, а не выведет
    curl_setopt($curl, CURLOPT_POSTFIELDS,
        array(
            'text' => $text,
            'coverdict' => 'bb-mix',
            'keep_isum' => '',
            'scroll_x' => '0',
            'scroll_y' => '0',
        ));
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36');
    curl_setopt($curl, CURLOPT_REFERER, "https://turgenev.ashmanov.com/"); //а вдруг там проверяют наличие рефера
    $res = curl_exec($curl);

    if (!$res) {
        $error = curl_error($curl) . '(' . curl_errno($curl) . ')';
        return $error;
    } else {
        $res = stristr($res, "<span class='tname'>Общий риск</span>");
        $res = stristr($res, '<li', true);
        $res = str_replace('</li>', ')', $res);
        $res = str_replace("<span class='ilevel'>", "(<span class='ilevel'>", $res);
        $res = str_replace('js/', 'https://turgenev.ashmanov.com/js/', $res);
        $res = str_replace('css/', 'https://turgenev.ashmanov.com/css/', $res);
        return $res;

    }
    curl_close($curl);

}





    $textclear = '';


if (isset($_POST['url'])) {
    $htmlfull = file_get_contents($_POST['url']);
}

if (isset($_GET['url'])) {
    $htmlfull = file_get_contents($_GET['url']);
}



    $pq = phpQuery::newDocument($htmlfull);


    /**
     * Города
     */


    $elem = $pq->find('.main__girl-text');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.main__form-caption mark');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.main__form-caption h1');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.main__form .main__form-left');
    $textclear .= strip_tags($elem->html())." <br><br>";



    $elem = $pq->find('.main__form .main__form-right');
    $textclear .= strip_tags($elem->html())." <br><br>";

// https://i.imgur.com/qjZW02o.png
    $elem = $pq->find('.text__section');
    $texttmp = explode('При расчете стоимости', strip_tags($elem->html()));
    $textclear .= $texttmp['0']." <br><br>";

// https://i.imgur.com/qjZW02o.png
    $elem = $pq->find('.service__section .section__caption');
    $textclear .= strip_tags($elem->html())." <br><br>";

// https://i.imgur.com/qjZW02o.png
    $elem = $pq->find('.service__section .service__text-wrap .service__title');
    $textclear .= strip_tags($elem->html())." <br><br>";

// https://i.imgur.com/qjZW02o.png
    $elem = $pq->find('.service__section .service__text-wrap .service__info');
    $textclear .= strip_tags($elem->html())." <br><br>";

// https://i.imgur.com/qjZW02o.png
    $elem = $pq->find('.service__section .service__text-wrap p');
    foreach ($elem as $element){
        $textclear .= strip_tags(pq($element)->html())." <br><br>";

    }

// https://i.imgur.com/qjZW02o.png
    $elem = $pq->find('.service__section .bottom_text');
    $textclear .= strip_tags($elem->html())." <br><br>";

// https://i.imgur.com/qjZW02o.png
    $elem = $pq->find('.service__section .service__bottom .service__price');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.callback__caption');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.warranty__section');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.callback__text');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.random__text-wrap');
    $texttmp = explode('<div class="random__button"', strip_tags($elem->html()));
    $textclear .= $texttmp['0']." <br><br>";


    $elem = $pq->find('.gallery__caption');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.gallery__text');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.discount__section .section__caption');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.discount__item:nth-child(1) .discount__text');
    $textclear .= strip_tags($elem->html())." <br><br>";



    $elem = $pq->find('.discount__item:nth-child(2) .discount__text');
    $textclear .= strip_tags($elem->html())." <br><br>";



    $elem = $pq->find('.discount__item:nth-child(3) .discount__text');
    $textclear .= strip_tags($elem->html())." <br><br>";



    $elem = $pq->find('.about__text');
    $textclear .= strip_tags($elem->html())." <br><br>";



    $elem = $pq->find('.services__section .section__caption');
    $textclear .= strip_tags($elem->html())." <br><br>";



    $elem = $pq->find('.services__section .text__content');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.services__section .services__wrap');

    foreach ($elem as $element){
        $textclear .= strip_tags(pq($element)->html())." <br><br>";

    }

    $elem = $pq->find('.map__form-caption');
    $textclear .= strip_tags($elem->html())." <br><br>";

    $elem = $pq->find('.map__form-numbers');
    $textclear .= strip_tags($elem->html())." <br><br>";

    $elem = $pq->find('.map__form button');
    $textclear .= strip_tags($elem->html())." <br><br>";

    $elem = $pq->find('.map__warranty');
    $textclear .= strip_tags($elem->html())." <br><br>";

    $elem = $pq->find('.how__section .section__caption');
    $textclear .= strip_tags($elem->html())." <br><br>";

    $elem = $pq->find('.how__section li');
    foreach ($elem as $element){
        $textclear .= strip_tags(pq($element)->html())." <br><br>";

    }



    $elem = $pq->find('.statistics__section .section__caption');
    $textclear .= strip_tags($elem->html())." <br><br>";

    $elem = $pq->find('.statistics__section .statistics__charts-text b');
    foreach ($elem as $element){
        $textclear .= strip_tags(pq($element)->html())." <br><br>";

    }

    $elem = $pq->find('.statistics__section .statistics__scheme-wrap .scheme__label');
    foreach ($elem as $element){
        $textclear .= strip_tags(pq($element)->html())." <br><br>";

    }




    $elem = $pq->find('.support__form-caption');
    $textclear .= strip_tags($elem->html())." <br><br>";

    $elem = $pq->find('.numbers__section .numbers__center-text');
    $textclear .= strip_tags($elem->html())." <br><br>";

    $elem = $pq->find('.numbers__section .numbers__item');
    foreach ($elem as $element){
        $textclear .= strip_tags(pq($element)->html())." <br><br>";

    }


    $elem = $pq->find('.reviews__description');
    $textclear .= strip_tags($elem->html())." <br><br>";


    $elem = $pq->find('.reviews__slider-wrap .reviews__item');
    foreach ($elem as $element){
        $textclear .= strip_tags(pq($element)->html())." <br><br>";

    }






//$textclear .= strip_tags($elem->html())." <br><br>";

if (isset($_POST['url'])) {
    echo get_o($textclear);
}

if (isset($_GET['url'])) {
    echo $textclear;
}









?>