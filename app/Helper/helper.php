<?php
function textLimit($html, $limit = 80, $end = '...')
{
    // Remove all HTML tags and decode HTML entities
    $text = strip_tags($html);
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');

    // Check if the text needs to be truncated
    if (strlen($text) <= $limit) {
        return $text;
    }

    // Truncate the text
    $limitedText = substr($text, 0, $limit) . $end;

    return $limitedText;
}
