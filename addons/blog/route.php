<?php

use think\facade\Route;

Route::rule('/blog', "\addons\blog\controller\index\Index@index");