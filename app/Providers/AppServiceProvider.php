<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\UserSession;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Model::preventLazyLoading(! app()->isProduction());

        Password::defaults(fn () => Password::min(10)
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised());

        RateLimiter::for('auth', fn ($request) => [
            Limit::perMinute(10)->by($request->ip()),
            Limit::perMinute(5)->by((string) $request->input('email') . '|' . $request->ip()),
        ]);

        RateLimiter::for('api-read', fn ($request) => Limit::perMinute(240)->by(optional($request->user())->id ?: $request->ip()));
        RateLimiter::for('contact', fn ($request) => Limit::perMinute(3)->by($request->ip()));

        DB::whenQueryingForLongerThan(500, function ($connection, $event) {
            Log::warning('Slow database query detected', [
                'connection' => $connection->getName(),
                'time_ms' => $event->time,
                'sql' => $event->toRawSql(),
            ]);
        });

        foreach ([Product::class, Category::class, Banner::class, Setting::class] as $model) {
            $model::saved(fn () => $this->forgetPublicApiCache());
            $model::deleted(fn () => $this->forgetPublicApiCache());
        }

        Order::saved(fn () => $this->forgetAdminStatsCache());
        Order::deleted(fn () => $this->forgetAdminStatsCache());

        Event::listen(Login::class, function (Login $event) {
            $request = request();
            UserSession::create([
                'user_id' => $event->user->id,
                'mac_address' => $request->cookie('user_mac_address') ?? $request->input('mac_address') ?? null,
                'device_id' => $request->cookie('device_id') ?? 'DEV-' . substr(md5($request->userAgent() . $request->ip()), 0, 8),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'session_id' => $request->session()->getId(),
                'login_at' => now(),
                'last_activity_at' => now(),
                'status' => 'active',
            ]);
        });

        Event::listen(Logout::class, function (Logout $event) {
            $session = UserSession::where('user_id', $event->user->id)
                ->where('session_id', request()->session()->getId())
                ->where('status', 'active')
                ->latest('login_at')
                ->first();

            if ($session) {
                $session->update([
                    'logout_at' => now(),
                    'last_activity_at' => now(),
                    'status' => 'ended',
                ]);
            }
        });
    }

    private function forgetPublicApiCache(): void
    {
        cache()->forget('api_home_categories');
        cache()->forget('api_home_featured');
        cache()->forget('api_home_best_selling');
        cache()->forget('api_home_banners');
        cache()->forget('api_categories_index');
        cache()->forget('api_settings_public');
    }

    private function forgetAdminStatsCache(): void
    {
        cache()->forget('admin_dashboard_stats');
        cache()->forget('admin_report_stats');
        cache()->forget('admin_notification_stats');
    }
}
