<?php
/**
 * Created by PhpStorm.
 * User: salva
 * Date: 21/02/18
 * Time: 16:41
 */

function setActiveRoute($name){
    return request()->routeIs($name) ? 'active' : '';
}

?>