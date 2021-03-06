<?php
declare(strict_types=1);

/*
 * This file is part of the  project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App;

use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;

/**
 * Class CacheKernel.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CacheKernel extends HttpCache
{
}