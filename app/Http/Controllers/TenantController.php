<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function changeTenant($tenantId): RedirectResponse
    {
        auth()->user()->tenants()->findOrFail($tenantId);
        auth()->user()->update(['current_tenant_id' => $tenantId]);

        return redirect()->route('dashboard');
    }
}
