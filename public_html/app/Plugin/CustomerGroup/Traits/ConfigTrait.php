<?php
/**
 * This file is part of CustomerGroup
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroup\Traits;


use Plugin\CustomerGroup\Entity\Config;
use Plugin\CustomerGroup\Repository\ConfigRepository;

trait ConfigTrait
{
    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    /**
     * @param ConfigRepository $configRepository
     * @required
     */
    public function setConfigRepository(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->configRepository->get();
    }
}
