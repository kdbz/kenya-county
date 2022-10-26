<?php 

namespace Kdbz\KenyaCounty;

use Illuminate\Support\ServiceProvider;

class KenyaCountyServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishResources();
        }
    }


    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/kenyacounty.php', 'kenyacounty');

        $this->app->bind('kenyacounty', function () {
            return new KenyaCounty();
        });
    }

    protected function publishResources()
    {
        $this->publishes([
            __DIR__ . '/config/kenyacounty.php' => config_path('kenyacounty.php'),
        ], 'kenyacounty-config');

        $this->publishes([
            __DIR__ . '/database/migrations/create_county_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_county_table.php'),
        ], 'kenyacounty-migrations');

        $this->publishes([
            __DIR__ . '/database/migrations/create_subcounty_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_subcounty_table.php'),
        ], 'kenyacounty-migrations');

        $this->publishes([
            __DIR__ . '/database/migrations/create_wards_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_wards_table.php'),
        ], 'kenyacounty-migrations');
        
        $this->publishes([
            __DIR__ . '/database/seeders/KenyaCountySeeder.php' => database_path('seeders/KenyaCountySeeder.php'),
        ], 'kenyacounty-seeders');

        $this->publishes([
            __DIR__ . '/database/seeders/data.xlsx' => database_path('seeders/data.xlsx'),
        ], 'kenyacounty-seeders');
    }

}