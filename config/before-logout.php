<?php
return function ($event)
{
    setcookie('_identity', null, -1, '/');
};