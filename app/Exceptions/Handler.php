<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\UnauthorizedException as ValidationUnauthorizedException;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e): RedirectResponse|Response
    {
        if (
            $e instanceof UnauthorizedException ||
            $e instanceof AuthorizationException ||
            $e instanceof ValidationUnauthorizedException
        ) {
            return redirect()->route('manager.dashboard')
                ->with('error', 'Access is restricted to managers only.');
        }

        return parent::render($request, $e);
    }
}