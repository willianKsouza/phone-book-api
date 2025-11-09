<?php
namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use League\Flysystem\UnableToWriteFile;
use Throwable;

class GlobalExceptionHandler
{

    public static array $handlers = [
        AuthenticationException::class => 'handleAuthenticationException',
        AccessDeniedHttpException::class => 'AccessDeniedHttpException',
        AuthorizationException::class => 'handleAuthorizationException',
        ValidationException::class => 'handleValidationException',
        ModelNotFoundException::class => 'handleNotFoundException',
        NotFoundHttpException::class => 'handleNotFoundException',
        MethodNotAllowedHttpException::class => 'handleMethodNotAllowedException',
        HttpException::class => 'handleHttpException',
        QueryException::class => 'handleQueryException',
        UnableToWriteFile::class => 'handleWriteFileException',
    ];

    public function handleWriteFileException(UnableToWriteFile $e, Request $request): JsonResponse
    {
        $this->logException($e, 'Write file in storage failed');

         return response()->json([
            'error' => [
                'message' => 'Write file in storage failed, check this file.' . $e->getMessage(),
            ]
        ], 500);
    }
    public function handleAuthenticationException(
        AuthenticationException|AccessDeniedHttpException $e, 
        Request $request
    ): JsonResponse {
        $this->logException($e, 'Authentication failed');

        return response()->json([
            'error' => [
                'message' => 'Authentication required. Please provide valid credentials.',
            ]
        ], 401);
    }

    public function handleAuthorizationException(
        AuthorizationException $e, 
        Request $request
    ): JsonResponse {
        $this->logException($e, 'Authorization failed');

        return response()->json([
            'error' => [
                'message' => 'You do not have permission to perform this action.',
            ]
        ], 403);
    }

 
    public function handleValidationException(
        ValidationException $e, 
        Request $request
    ): JsonResponse {
        $errors = [];
        
        foreach ($e->errors() as $field => $messages) {
            foreach ($messages as $message) {
                $errors[] = [
                    'field' => $field,
                    'message' => $message,
                ];
            }
        }

        $this->logException($e, 'Validation failed', ['errors' => $errors]);

        return response()->json([
            'error' => [
                'message' => 'The provided data is invalid.',
                'validation_errors' => $errors,
            ]
        ], 422);
    }

    public function handleNotFoundException(
        ModelNotFoundException|NotFoundHttpException $e, 
        Request $request
    ): JsonResponse {
        $this->logException($e, 'Resource not found');

        $message = $e instanceof ModelNotFoundException 
            ? 'The requested resource was not found.'
            : "The requested endpoint '{$request->getRequestUri()}' was not found.";

        return response()->json([
            'error' => [
                'message' => $message,
            ]
        ], 404);
    }

    public function handleMethodNotAllowedException(
        MethodNotAllowedHttpException $e, 
        Request $request
    ): JsonResponse {
        $this->logException($e, 'Method not allowed');

        return response()->json([
            'error' => [
                'message' => "The {$request->method()} method is not allowed for this endpoint.",
                'allowed_methods' => $e->getHeaders()['Allow'] ?? 'Unknown',
            ]
        ], 405);
    }

  
    public function handleHttpException(HttpException $e, Request $request): JsonResponse
    {
        $this->logException($e, 'HTTP exception occurred');

        return response()->json([
            'error' => [
                'message' => $e->getMessage() ?: 'An HTTP error occurred.',
            ]
        ], $e->getStatusCode());
    }

    public function handleQueryException(QueryException $e, Request $request): JsonResponse
    {
        $this->logException($e, 'Database query failed', ['sql' => $e->getSql()]);

        $errorCode = $e->errorInfo[1] ?? null;
        
        switch ($errorCode) {
            case 1451:
                return response()->json([
                    'error' => [
                        'message' => 'Cannot delete this resource because it is referenced by other records.',
                    ]
                ], 409);
                
            case 1062:
                return response()->json([
                    'error' => [
                        'message' => 'A record with this information already exists.',
                    ]
                ], 409);
                
            default:
                return response()->json([
                    'error' => [
                        'message' => 'A database error occurred. Please try again later.',
                    ]
                ], 503);
        }
    }

    private function logException(Throwable $e, string $message, array $context = []): void
    {
        $logContext = array_merge([
            'exception' => get_class($e),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'ip' => request()->ip(),
        ], $context);

        Log::warning($message, $logContext);
    }
}