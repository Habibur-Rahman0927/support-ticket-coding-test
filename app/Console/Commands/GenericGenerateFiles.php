<?php

namespace App\Console\Commands;

use App\Console\Commands\Concerns\BaseCommand;

class GenericGenerateFiles extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-files {name : The name of the files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new controller and associated request files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        $nameUcfirst = ucfirst($name);
        if (empty($name)) {
            $this->error('The name argument cannot be empty.');
            return;
        }

        try {
            $controllerGenerated = $this->generateController($nameUcfirst) &&
                                   $this->generateRequest($nameUcfirst, 'Create') &&
                                   $this->generateRequest($nameUcfirst, 'Update');

            $repositoryGenerated = $this->generateRepositoryInterfaceFile($nameUcfirst) &&
                                   $this->generateImplementRepositoryFile($nameUcfirst);

            $serviceGenerated = $this->generateServiceInterfaceFile($nameUcfirst) &&
                                $this->generateImplementServiceFile($nameUcfirst);

            if ($controllerGenerated && $repositoryGenerated && $serviceGenerated) {
                $this->info("Controller, Repository, Service, and associated request files generated successfully: " . $nameUcfirst);
            } else {
                $this->error('Some files were not generated. Please check the errors and try again.');
            }
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
