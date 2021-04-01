<?php

namespace OpenCensus\Trace\Integrations;

use Illuminate\Support\Facades\Cache;
use OpenCensus\Trace\Span;

class LaravelCache implements IntegrationInterface
{
    public function load()
    {
        if (!extension_loaded('opencensus')) {
            trigger_error('opencensus extension required to load LaravelCache integrations.', E_USER_WARNING);
            return;
        }

        opencensus_trace_method(Cache::class, 'put', function ($cache) {
            return [
                'name' => 'cache/put',
                'kind' => Span::KIND_CLIENT
            ];
        });

        opencensus_trace_method(Cache::class, 'remember', function ($cache) {
            return [
                'name' => 'cache/remember',
                'kind' => Span::KIND_CLIENT
            ];
        });
    }
}