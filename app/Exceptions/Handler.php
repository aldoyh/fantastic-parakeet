<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        // Check for memory-related errors and log detailed memory information
        if ($this->isMemoryError($exception)) {
            $this->logMemoryError($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Check if the exception is memory-related.
     *
     * @param  \Throwable  $exception
     * @return bool
     */
    private function isMemoryError(Throwable $exception): bool
    {
        $message = $exception->getMessage();
        
        // Check for common memory error patterns
        $memoryErrorPatterns = [
            'Allowed memory size of',
            'Out of memory',
            'memory exhausted',
            'Cannot allocate memory',
            'Maximum execution time exceeded' // Often related to infinite loops causing memory issues
        ];

        foreach ($memoryErrorPatterns as $pattern) {
            if (stripos($message, $pattern) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Log detailed memory error information.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    private function logMemoryError(Throwable $exception): void
    {
        $memoryInfo = [
            'exception_type' => get_class($exception),
            'exception_message' => $exception->getMessage(),
            'exception_file' => $exception->getFile(),
            'exception_line' => $exception->getLine(),
            'current_memory_usage' => $this->formatBytes(memory_get_usage(true)),
            'peak_memory_usage' => $this->formatBytes(memory_get_peak_usage(true)),
            'memory_limit' => ini_get('memory_limit'),
            'real_memory_usage' => $this->formatBytes(memory_get_usage(false)),
            'real_peak_memory_usage' => $this->formatBytes(memory_get_peak_usage(false)),
            'timestamp' => now()->toISOString(),
        ];

        // Log the memory error with context
        logger()->critical('Memory Error Detected', $memoryInfo);
        
        // Also log to stderr if in production for immediate visibility
        if (app()->environment('production')) {
            error_log('MEMORY ERROR: ' . json_encode($memoryInfo, JSON_UNESCAPED_SLASHES));
        }
    }

    /**
     * Format bytes into human readable format.
     *
     * @param  int  $size
     * @return string
     */
    private function formatBytes(int $size): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, 2) . ' ' . $units[$i];
    }
}
