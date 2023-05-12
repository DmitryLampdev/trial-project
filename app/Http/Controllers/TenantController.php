<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function changeTenant($tenantHash): RedirectResponse
    {
        $tenant = auth()->user()->tenants()->firstWhere('tenant_hash', $tenantHash);
        auth()->user()->update(['current_tenant_id' => $tenant->id]);

        return redirect()->route('dashboard');
    }
}
