<?php

function show_name() {
    return 'Aya Hosny';
}

function get_languages() {
     return \App\Models\Language::active() -> Selection() -> get();
}


function get_default_lang(){
    return Config::get('app.locale');
}

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}

function uploadImages($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path =  $folder . '/' . $filename;
    return $path;
}

