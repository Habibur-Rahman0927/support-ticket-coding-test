<?php

namespace App\Providers;

use App\Repositories\Ticket\ITicketRepository;
use App\Repositories\Ticket\TicketRepository;
use App\Repositories\TicketResponse\ITicketResponseRepository;
use App\Repositories\TicketResponse\TicketResponseRepository;
use App\Services\Ticket\ITicketService;
use App\Services\Ticket\TicketService;
use Illuminate\Support\ServiceProvider;

class ServiceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $repositories = [
            ITicketRepository::class => TicketRepository::class,
            ITicketResponseRepository::class => TicketResponseRepository::class
        ];

        $services = [
            ITicketService::class => TicketService::class
        ];
        
        $bindings = array_merge($repositories, $services);
        $this->bindServiceRepositories($bindings);
    }

    /**
     * Helper function to bind repository interfaces to their implementations
     */
    protected function bindServiceRepositories(array $servicesRepositories): void
    {
        foreach ($servicesRepositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
