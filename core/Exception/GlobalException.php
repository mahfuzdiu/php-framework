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

    /**
     *registers handler for exception and errors
     */
    public function registerErrorHandler(): void
    {
        set_exception_handler([$this, 'handleException']);
        set_error_handler([$this, 'handleError']);
        register_shutdown_function([$this, 'handleShutdown']);
    }

    public function handleException(Throwable $exception): void
    {
        $errorMessageHandler = new ErrorMessageHandler();
        $statusCode = $exception->getCode() ?: self::DEFAULT_EXCEPTION_ERROR_CODE;
        $errors = [
            "message" => json_decode($errorMessageHandler->getErrorMessage($exception), true),
            "file" => $exception->getFile(),
            "line" =>  $exception->getLine()
        ];

        if(!is_array($errors["message"])){
            $errors["message"] = $errorMessageHandler->getErrorMessage($exception);
        }

        $this->response->jsonResponse($errors, $statusCode);
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