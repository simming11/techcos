<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Contracts\Config\Repository as Config;

class TrustProxies extends Middleware
{
    // คุณสามารถปรับแต่ง middleware ได้ตามต้องการ
}
