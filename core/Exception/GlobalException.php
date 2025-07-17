<?php

namespace Core\Exception;

use Core\Request\Request;
use Core\Response;
use ErrorException;
use Throwable;

class GlobalException
{
    const DEFAULT_EXCEPTION_ERROR_CODE = 500;

    public function __construct(private Response $response){}

    public function registerErrorHandler(): void
    {
        set_exception_handler([$this, 'handleException']);
        set_error_handler([$this, 'handleError']);
        register_shutdown_function([$this, 'handleShutdown']);
    }

    public function handleException(Throwable $exception): void
    {
        $errorMessageHandler = new ErrorMessageHandler();
        $errors = json_decode($errorMessageHandler->getErrorMessage($exception), true);
        $statusCode = $exception->getCode() ?: self::DEFAULT_EXCEPTION_ERROR_CODE;

        if(is_array($errors)){
            $this->response->jsonResponse($errors, $statusCode);
            exit;
        }

        $this->response->jsonResponse($errorMessageHandler->getErrorMessage($exception), $statusCode);
        exit;
    }

    public function handleError(int $errno, string $errstr, string $errfile, int $errline): bool
    {
        if (!(error_reporting() & $errno)) {
            return false;
        }

        $fatalErrorTypes = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR];
        if (in_array($errno, $fatalErrorTypes)) {
            return false;
        }

        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

    public function handleShutdown(): void
    {
        $error = error_get_last();
        if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            throw new \ErrorException(
                $error['message'],
                0,
                $error['type'],
                $error['file'],
                $error['line']
            );
        }
    }
}