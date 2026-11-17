<?php

namespace Tests\Unit;

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersTest extends TestCase
{
    public function test_it_prevents_framing(): void
    {
        $request = Request::create('/');
        $middleware = new SecurityHeaders;

        $response = $middleware->handle($request, fn () => new Response('ok'));

        $this->assertSame('DENY', $response->headers->get('X-Frame-Options'));
        $this->assertSame("frame-ancestors 'none'", $response->headers->get('Content-Security-Policy'));
    }
}
