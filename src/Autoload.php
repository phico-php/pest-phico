<?php

declare(strict_types=1);

namespace Phico\Pest;

use Pest\Plugin;
use PHPUnit\Framework\TestCase;

/**
 *  Add classes
 */
// Plugin::uses(Example::class);
Plugin::uses(HttpTrait::class);

// /**
//  * @return TestCase
//  */
// function example(string $argument)
// {
//     return test()->example(...func_get_args()); // @phpstan-ignore-line
// }
//
//

/**
 *  Add function call aliases as required
 */

/**
 * @return TestCase
 */
function get(string $uri, array $options = [])
{
    return test()->get(...func_get_args()); // @phpstan-ignore-line
}
/**
 * @return TestCase
 */
function post(string $uri, array $body = [], array $options = [])
{
    return test()->get(...func_get_args()); // @phpstan-ignore-line
}
