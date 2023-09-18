<?php

namespace Vendordevms\FedexShipping\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallFedexShipping extends Command
{
    protected $signature = 'fedexshipping:install';

    protected $description = 'Install the FedexShipping';

    public function handle()
    {
        $this->info('Installing FedexShipping...');

        $this->info('Publishing configuration...');

        if (! $this->configExists('fedex-shiiping.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed FedexShiiping');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Vendordevms\FedexShipping\FedexShippingServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

       $this->call('vendor:publish', $params);
    }
}