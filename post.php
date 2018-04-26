<?php
require('phpQuery/phpQuery.php');

function get_o ($text) {


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://turgenev.ashmanov.com/');
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS,
        array(
            'email' => '***', //your login
            'password' => '***' //your password
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


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://turgenev.ashmanov.com/');
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Cookie: usess=" . $res));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS,
        array(
            'text' => $text,
            'coverdict' => 'bb-mix',
            'keep_isum' => '',
            'scroll_x' => '0',
            'scroll_y' => '0',
        ));
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36');
    curl_setopt($curl, CURLOPT_REFERER, "https://turgenev.ashmanov.com/");
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



if (isset($_POST['text'])) {
    echo get_o($_POST['text']);
}








?>