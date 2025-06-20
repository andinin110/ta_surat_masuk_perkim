<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\emailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyemailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(emailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedemail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markemailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
