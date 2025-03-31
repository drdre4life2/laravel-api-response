# Laravel API Response Package

## Introduction
This package provides a standardized way to return JSON responses in Laravel applications. It simplifies response handling for success, validation, client errors, and server errors.

## Installation

Install the package via Composer:
```bash
composer require drdre4life2/api-response
```

Next, publish the configuration file (if needed):
```bash
php artisan vendor:publish --tag=api-response-config
```

## Usage

### Include the Trait
Add the `HasApiResponse` trait to your base `Controller`:

```php
namespace App\Http\Controllers;

use Drdre4life2001\ApiResponse\Traits\HasApiResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use HasApiResponse;
}
```

### Available Methods
#### Success Responses
```php
return $this->okResponse('Success message', ['key' => 'value']);
return $this->createdResponse('Resource created', ['id' => 1]);
return $this->noContentResponse();
```

#### Client Error Responses
```php
return $this->badRequestResponse('Invalid request', ['error' => 'Details']);
return $this->unauthenticatedResponse('Unauthorized');
return $this->forbiddenResponse('Access denied');
return $this->notFoundResponse('Resource not found');
```

#### Server Error Responses
```php
return $this->serverErrorResponse('Server error occurred');
```

### Example in a Controller
```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index(Request $request)
    {
        $data = ['message' => 'Hello, World!'];
        return $this->okResponse('Data retrieved successfully', $data);
    }
}
```

## Testing
Run the test suite with:
```bash
php artisan test
```

## License
This package is open-source software licensed under the MIT License.

