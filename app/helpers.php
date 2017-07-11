<?php

function query_except($droppedKey, $droppedValue)
{
    return http_build_query(Request::except($droppedKey)) . '&' . $droppedKey . '=' . $droppedValue;
}