<?php

namespace App\Http\Controllers;

use App\Enums\PositionStatusEnum;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionUpdateStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Position $position)
    {
        $status = $request->status;
        if(PositionStatusEnum::tryFrom($status) !== null){
            $position->update(['status' => $status]);
            return redirect("/status/success");
        }

        return 'This link is might be broken or expired!';
    }
}
