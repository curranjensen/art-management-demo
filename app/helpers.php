<?php

function query_except($droppedKey, $droppedValue)
{
    return http_build_query(Request::except($droppedKey)) . '&' . $droppedKey . '=' . $droppedValue;
}

function get_medium_dropdown()
{
    return \App\Medium::where('id', request('media_id'))->get()->pluck('type')->first();
}

function get_category_dropdown()
{
    return \App\Category::where('id', request('category_id'))->get()->pluck('type')->first();
}