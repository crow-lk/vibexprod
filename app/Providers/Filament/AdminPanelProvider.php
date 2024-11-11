<?php

namespace App\Providers\Filament;

use App\Filament\Resources\MembersResource\Widgets\MembersChart;
use App\Filament\Resources\MembersResource\Widgets\MembersOverview;
use App\Filament\Resources\MembersResource\Widgets\TodayPaymentMembers;
use App\Filament\Resources\SubscriptionPaymentsResource\Widgets\LatePayments;
use App\Models\Members;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
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
use Solutionforest\FilamentScaffold\FilamentScaffoldPlugin;
use Filament\Widgets\Grid;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\FilamentInfoWidget::class,
				MembersOverview::class,
                TodayPaymentMembers::class,
                LatePayments::class,

				MembersChart::class,
                
                // Widgets\AccountWidget::class,
                
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])

            ->navigationGroups([
                NavigationGroup::make()
                     ->label('Gym Member Management')->collapsed(),
                NavigationGroup::make()
                    ->label('Subscription Packages')->collapsed(),
                NavigationGroup::make()
                    ->label('Gym Expenses')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Reports')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('System')
            ])

            ->plugin(FilamentScaffoldPlugin::make());
    }
}
