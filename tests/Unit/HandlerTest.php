<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Log;
use Exception;

class HandlerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // Mock the logger to capture log entries
        Log::spy();
    }

    /**
     * Test that memory errors are detected and logged correctly.
     *
     * @return void
     */
    public function testMemoryErrorDetectionAndLogging()
    {
        $handler = new Handler($this->app);
        
        // Create a mock memory error exception
        $memoryException = new Exception('Fatal error: Allowed memory size of 134217728 bytes exhausted (tried to allocate 20480 bytes)');
        
        // Report the exception
        $handler->report($memoryException);
        
        // Assert that the critical log was called with memory error details
        Log::shouldHaveReceived('critical')
            ->with('Memory Error Detected', \Mockery::type('array'))
            ->once();
    }

    /**
     * Test that non-memory errors are not detected as memory errors.
     *
     * @return void
     */
    public function testNonMemoryErrorNotDetected()
    {
        $handler = new Handler($this->app);
        
        // Create a regular exception
        $regularException = new Exception('Regular error message');
        
        // Report the exception
        $handler->report($regularException);
        
        // Assert that the critical log was NOT called for memory errors
        Log::shouldNotHaveReceived('critical')
            ->with('Memory Error Detected', \Mockery::any());
    }

    /**
     * Test various memory error patterns are detected.
     *
     * @return void
     */
    public function testVariousMemoryErrorPatterns()
    {
        $handler = new Handler($this->app);
        
        $memoryErrorMessages = [
            'Allowed memory size of 256M exhausted',
            'Out of memory (allocated 2097152)',
            'PHP Fatal error: memory exhausted',
            'Cannot allocate memory for string',
            'Maximum execution time exceeded'
        ];
        
        foreach ($memoryErrorMessages as $message) {
            $exception = new Exception($message);
            $handler->report($exception);
        }
        
        // Assert that critical log was called for each memory error
        Log::shouldHaveReceived('critical')
            ->with('Memory Error Detected', \Mockery::type('array'))
            ->times(count($memoryErrorMessages));
    }
}