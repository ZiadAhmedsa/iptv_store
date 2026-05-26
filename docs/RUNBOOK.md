# IPTV Store Runbook

## Production Deploy

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan optimize
php artisan queue:restart
```

Flutter release:

```bash
flutter build apk --release --obfuscate --split-debug-info=build/debug-info --dart-define=API_SCHEME=https --dart-define=API_HOST=your-domain.example
```

## Redis

Required production values:

```env
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
REDIS_QUEUE=default
```

Verify:

```bash
php artisan tinker
cache()->put('healthcheck', 'ok', 60);
cache()->get('healthcheck');
```

## Queue Workers

Install Supervisor config from `deploy/supervisor/iptv-store-worker.conf`.

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl status
```

Horizon is recommended on Linux production:

```bash
composer require laravel/horizon
php artisan horizon:install
php artisan migrate
php artisan horizon
```

Windows PHP usually lacks `pcntl` and `posix`, so install Horizon on the Linux server, not on this local XAMPP runtime.

## Monitoring

Sentry:

```bash
composer require sentry/sentry-laravel
php artisan sentry:publish --dsn=https://public@example.ingest.sentry.io/project
```

Flutter:

```bash
flutter pub add sentry_flutter
```

Pulse:

```bash
composer require laravel/pulse
php artisan vendor:publish --provider="Laravel\Pulse\PulseServiceProvider"
php artisan migrate
```

## Backup And Restore

Backup:

```powershell
powershell -ExecutionPolicy Bypass -File scripts/backup.ps1
```

Restore database:

```bash
mysql -u USER -p DATABASE < backup.sql
```

Always test restore on staging after changing backup policy.

## Load Testing

Read-only plus checkout path:

```bash
k6 run -e BASE_URL=https://your-domain.example/api -e API_TOKEN=token -e PRODUCT_ID=1 tests/load/checkout.k6.js
```

Start with 50 to 200 VUs, then scale to 1,000 VUs only after database CPU, Redis memory, and PHP-FPM saturation are understood.

## Incident Checklist

1. Check `/up`, PHP-FPM, Nginx, MySQL, Redis.
2. Check `storage/logs/laravel.log` and queue worker logs.
3. Run `php artisan queue:failed` and retry only idempotent jobs.
4. If checkout errors occur, inspect product stock and order_items consistency.
5. If Redis is down, switch cache/session/queue only according to the documented fallback plan.
