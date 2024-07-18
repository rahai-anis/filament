<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('user')
            ->path('user') // Adjust the path for user panel
            ->login()
            ->colors([
                'primary' => Color::Blue, // Customize colors as needed
            ])
            ->discoverResources(app_path('Filament/User/Resources'), 'App\\Filament\\User\\Resources')
            ->discoverPages(app_path('Filament/User/Pages'), 'App\\Filament\\User\\Pages')
            ->pages([
                Pages\Dashboard::class, // Example dashboard page for users
            ])
            ->discoverWidgets(app_path('Filament/User/Widgets'), 'App\\Filament\\User\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                // Additional widgets for user panel
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                // Additional middleware specific to user panel
            ])
            /*->authMiddleware([
                Authenticate::class,
                // Additional authentication middleware if required
            ]);*/
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
