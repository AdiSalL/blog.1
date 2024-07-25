<?php

namespace Pc\Blogapp\Middleware;

interface Middleware {
    function before():void;
}