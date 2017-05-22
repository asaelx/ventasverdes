<?php

function currency($number){
    return number_format( (float) $number, 2, '.', ',' );
}

function youtube_id($url){
    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
    return $matches[1];
}

function youtube_embed($url){
    $id = youtube_id($url);
    return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe>';
}

function youtube_thumbnail_url($url){
    $id = youtube_id($url);
    return 'https://img.youtube.com/vi/' . $id . '/default.jpg';
}
