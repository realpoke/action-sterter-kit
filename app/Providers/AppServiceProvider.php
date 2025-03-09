<?php

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Date::use(CarbonImmutable::class);

        ResetPassword::createUrlUsing(function (mixed $user, string $token) {
            if (! $user instanceof User) {
                throw new InvalidArgumentException('User must be an instance of User');
            }

            return route(
                'password.reset.page', [
                    'token' => $token,
                    'email' => $user->email,
                ]);
        });

        VerifyEmail::createUrlUsing(function (mixed $notifiable) {
            if (! $notifiable instanceof User) {
                throw new InvalidArgumentException('User must be an instance of User');
            }

            return URL::temporarySignedRoute(
                'email.verify.link',
                Carbon::now()->addMinutes(60),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1((string) $notifiable->getEmailForVerification()),
                ]
            );
        });
    }
}
