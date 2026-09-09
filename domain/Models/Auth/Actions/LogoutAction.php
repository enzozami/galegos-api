<?php

namespace Gal\Models\Auth\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class LogoutAction
{
    public function handle(Request $request): void
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
