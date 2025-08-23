<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * Memory error patterns for detection.
     */
    private const MEMORY_ERROR_PATTERNS = [
        'Allowed memory size of',
        'Out of memory',
        'memory exhausted',
        'Cannot allocate memory',
        'Maximum execution time exceeded', // Often related to infinite loops causing memory issues
        'Fatal error: Out of memory',
        'PHP Fatal error: Allowed memory size',
        'memory limit exceeded',
        'stack overflow',
        'Segmentation fault', // Can be memory-related
    ];

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
        'current_password',
        'password_new',
        'password_confirm',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception): void
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
     * @param  \Throwable  $exception
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
        
        // Early return for empty messages
        if (empty($message)) {
            return false;
        }

        // Check for common memory error patterns using case-insensitive search
        foreach (self::MEMORY_ERROR_PATTERNS as $pattern) {
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
        try {
            $memoryLimit = $this->getMemoryLimitInBytes();
            $currentMemory = memory_get_usage(true);
            $peakMemory = memory_get_peak_usage(true);
            
            $memoryInfo = [
                'exception_type' => get_class($exception),
                'exception_message' => $exception->getMessage(),
                'exception_file' => $exception->getFile(),
                'exception_line' => $exception->getLine(),
                'current_memory_usage' => $this->formatBytes($currentMemory),
                'current_memory_bytes' => $currentMemory,
                'peak_memory_usage' => $this->formatBytes($peakMemory),
                'peak_memory_bytes' => $peakMemory,
                'memory_limit' => ini_get('memory_limit'),
                'memory_limit_bytes' => $memoryLimit,
                'memory_usage_percentage' => $memoryLimit > 0 ? round(($peakMemory / $memoryLimit) * 100, 2) : null,
                'real_memory_usage' => $this->formatBytes(memory_get_usage(false)),
                'real_peak_memory_usage' => $this->formatBytes(memory_get_peak_usage(false)),
                'timestamp' => now()->toISOString(),
                'url' => request()->fullUrl() ?? 'N/A',
                'user_agent' => request()->userAgent() ?? 'N/A',
            ];

            // Log the memory error with context
            logger()->critical('Memory Error Detected', $memoryInfo);
            
            // Also log to stderr if in production for immediate visibility
            if (app()->environment('production')) {
                error_log('MEMORY ERROR: ' . json_encode($memoryInfo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            }
        } catch (Throwable $e) {
            // Fallback logging if memory info gathering fails
            logger()->critical('Memory Error Detected (minimal info)', [
                'exception_message' => $exception->getMessage(),
                'timestamp' => now()->toISOString(),
            ]);
        }
    }

    /**
     * Get memory limit in bytes.
     *
     * @return int
     */
    private function getMemoryLimitInBytes(): int
    {
        $memoryLimit = ini_get('memory_limit');
        
        if ($memoryLimit === '-1') {
            return -1; // No limit
        }
        
        $value = (int) $memoryLimit;
        $unit = strtolower(substr($memoryLimit, -1));
        
        switch ($unit) {
            case 'g':
                $value *= 1024 * 1024 * 1024;
                break;
            case 'm':
                $value *= 1024 * 1024;
                break;
            case 'k':
                $value *= 1024;
                break;
        }
        
        return $value;
    }

    /**
     * Format bytes into human readable format.
     *
     * @param  int  $size
     * @return string
     */
    private function formatBytes(int $size): string
    {
        if ($size === 0) {
            return '0 B';
        }
        
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $unitIndex = 0;
        
        while ($size >= 1024 && $unitIndex < count($units) - 1) {
            $size /= 1024;
            $unitIndex++;
        }
        
        return round($size, 2) . ' ' . $units[$unitIndex];
    }
}
