<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use Illuminate\Http\JsonResponse;

class TicketStatisticsController extends Controller
{
    protected TicketRepository $tickets;

    public function __construct(TicketRepository $tickets)
    {
        $this->tickets = $tickets;
    }

    public function __invoke(): JsonResponse
    {
        $stats = $this->tickets->getStatistics();

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }
}
