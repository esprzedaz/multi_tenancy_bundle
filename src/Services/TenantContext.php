<?php

namespace Hakam\MultiTenancyBundle\Services;

use LogicException;

class TenantContext
{
    private string $tenant;
    private bool $isInitialized = false;

    public function init(string $tenantKey): void
    {
        $this->isInitialized = true;
        $this->tenant = $tenantKey;
    }

    public function getCurrentTenantKey(): string
    {
        if (!$this->isInitialized) {
            throw new LogicException('Tenant Context not initialized');
        }

        return $this->tenant;
    }
}