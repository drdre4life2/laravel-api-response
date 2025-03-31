<?php

namespace Drdre4life2\ApiResponse\Tests;

use Illuminate\Http\JsonResponse;
use YourVendor\ApiResponse\Traits\HasApiResponse;
use PHPUnit\Framework\TestCase;

class HasApiResponseTest extends TestCase
{
    use HasApiResponse;

    public function test_okResponse_returns_correct_json()
    {
        $response = $this->okResponse('Success', ['foo' => 'bar']);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertEquals([
            'status' => true,
            'message' => 'Success',
            'data' => ['foo' => 'bar'],
        ], $response->getData(true));
    }

    public function test_serverErrorResponse_logs_exception_and_returns_500()
    {
        $exception = new \Exception('Server failure', 500);
        $response = $this->serverErrorResponse('Internal error', 500, $exception);

        $this->assertEquals(500, $response->status());
        $this->assertEquals([
            'status' => false,
            'message' => 'Internal error',
        ], $response->getData(true));
    }
}
