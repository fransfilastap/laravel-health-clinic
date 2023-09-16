<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class BaseException extends \Exception
{
    /**
     * Report the exception.
     */
    abstract public function report(): void;

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response(content: $this->getMessage(),status: 500);
    }
}
