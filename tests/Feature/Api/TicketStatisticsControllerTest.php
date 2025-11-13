<?php

namespace Tests\Feature\Api;

use Database\Seeders\TicketSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Ticket;

class TicketStatisticsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_ticket_statistics_successfully()
    {
        $this->seed(TicketSeeder::class);

        // Act: викликаємо API
        $response = $this->getJson('/api/tickets/statistics');

        // Assert: перевіряємо статус і структуру JSON
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'daily' => [
                        'processed',
                        'new',
                        'in_progress',
                    ],
                    'weekly' => [
                        'processed',
                        'new',
                        'in_progress',
                    ],
                    'monthly' => [
                        'processed',
                        'new',
                        'in_progress',
                    ],
                ],
            ])
            ->assertJson([
                'success' => true,
            ]);

        $stats = $response->json('data');

        foreach (['daily', 'weekly', 'monthly'] as $period) {
            foreach (['processed', 'new', 'in_progress'] as $status) {
                $this->assertIsInt($stats[$period][$status]);
            }
        }
    }

//    public function test_it_handles_repository_exception_gracefully()
//    {
//        // для тесту випадку 500 - замоканий репозиторій
//        $this->mock(\App\Repositories\TicketRepository::class, function ($mock) {
//            $mock->shouldReceive('getStatistics')->andThrow(new \Exception('DB error'));
//        });
//
//        $response = $this->getJson('/api/tickets/statistics');
//
//        $response->assertStatus(500)
//            ->assertJson([
//                'success' => false,
//            ]);
//    }
}
