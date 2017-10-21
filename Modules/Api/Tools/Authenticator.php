<?php

namespace Modules\Api\Tools;

use Illuminate\Http\Request;

class Authenticator
{
    public function is_admin(Request $request)
    {
        $header = $request->headers();

    }
}