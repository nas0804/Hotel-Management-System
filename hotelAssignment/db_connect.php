<?php
function db_connect()
{
    return $db = new SQLite3("S&M Hotel Database.db");
}
?>