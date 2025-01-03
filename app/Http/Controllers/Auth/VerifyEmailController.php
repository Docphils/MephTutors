<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectBasedOnRole($request->user(), '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectBasedOnRole($request->user(), '?verified=1');
    }

    /**
     * Redirect user based on their role after email verification.
     */
    protected function redirectBasedOnRole($user, $query = ''): RedirectResponse
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard', $query);
            case 'tutor':
                return redirect()->route('tutor.dashboard', $query);
            case 'client':
                return redirect()->route('client.dashboard', $query);
            default:
                return redirect(RouteServiceProvider::HOME . $query);
        }
    }
}
