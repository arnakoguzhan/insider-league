<?php

namespace App\Traits;

use Illuminate\Support\Fluent;

/**
 * Helper trait to run actions without inject them into the controller's method
 */
trait AsAction
{
    /**
     * @return static
     */
    public static function make()
    {
        return app(static::class);
    }

    /**
     * @see static::handle()
     * @param mixed ...$arguments
     * @return mixed
     */
    public static function run(...$arguments)
    {
        return static::make()->handle(...$arguments);
    }

    /**
     * @param $boolean
     * @param ...$arguments
     * @return mixed|\Illuminate\Support\Fluent
     */
    public static function runIf($boolean, ...$arguments)
    {
        return $boolean ? static::run(...$arguments) : new Fluent;
    }

    /**
     * @param $boolean
     * @param ...$arguments
     * @return mixed|\Illuminate\Support\Fluent
     */
    public static function runUnless($boolean, ...$arguments)
    {
        return static::runIf(!$boolean, ...$arguments);
    }
}
