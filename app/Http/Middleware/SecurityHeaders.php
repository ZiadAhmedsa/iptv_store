<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $response->headers->set('X-Request-Id', (string) str($request->headers->get('X-Request-Id') ?: str()->uuid()));

        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        if (config('security.csp.enabled')) {
            $header = config('security.csp.report_only')
                ? 'Content-Security-Policy-Report-Only'
                : 'Content-Security-Policy';

            $response->headers->set($header, $this->buildCspHeader());
        }

        if (! $response->headers->has('Cache-Control') && $request->is('api/*')) {
            $response->headers->set('Cache-Control', 'no-store, private');
        }

        return $response;
    }

    private function buildCspHeader(): string
    {
        $directives = collect(config('security.csp.directives'))
            ->map(function (array $values, string $directive) {
                return trim($directive . ' ' . implode(' ', $values));
            })
            ->values();

        if ($reportUri = config('security.csp.report_uri')) {
            $directives->push('report-uri ' . $reportUri);
        }

        return $directives->implode('; ');
    }
}
