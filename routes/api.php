<?php
use App\Models\Dokter;

Route::get('/sip-next', function () {

    $lastSip = Dokter::orderBy('id', 'DESC')->value('sip');

    $next = 1;

    if ($lastSip) {
        // Format: SIP0001
        $num = intval(substr($lastSip, 3)); 
        $next = $num + 1;
    }

    $nextSip = "SIP" . str_pad($next, 4, '0', STR_PAD_LEFT);

    return response()->json([
        "next_sip" => $nextSip
    ]);
});
