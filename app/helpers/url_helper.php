<?php

// Simple page redirect
function redirect(string $page)
{
    header('Location: ' . URL_ROOT . $page);
}