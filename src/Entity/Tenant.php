<?php

namespace Hakam\MultiTenancyBundle\Entity;

use Hakam\MultiTenancyBundle\Services\TenantDbConfigurationInterface;
use Hakam\MultiTenancyBundle\Traits\TenantDbConfigTrait;

class Tenant implements TenantDbConfigurationInterface
{
    use TenantDbConfigTrait;

    protected string $key;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }


}
