<?php

declare(strict_types=1);

/*
 * This file is part of the bileMo project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Presenters;

use App\UI\Presenters\Interfaces\CreateUserPresenterInterface;

/**
 * Class CreateUserPresenter
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserPresenter implements CreateUserPresenterInterface
{
    /**
     * @return string
     */
    public function prepare(): string
    {
        return 'L\'utilisateur a bien été ajouté à la base de données';
    }
}
