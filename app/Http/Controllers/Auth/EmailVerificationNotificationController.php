<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class emailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedemail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendemailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
