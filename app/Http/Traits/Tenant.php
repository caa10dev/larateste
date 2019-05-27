<?php

namespace App\Http\Traits;

// Tenants
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

trait Tenant {
	/**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        $subdomainclient = str_replace('.miller.localhost', '', Request::server('SERVER_NAME'));

        if($subdomainclient != 'miller.localhost'){
            // // Erase the tenant connection, thus making Laravel get the default values all over again.
            DB::purge('mysql');
            
            // Rearrange the connection data
            DB::connection($subdomainclient);
            DB::setDefaultConnection($subdomainclient);
        }
    }
}
