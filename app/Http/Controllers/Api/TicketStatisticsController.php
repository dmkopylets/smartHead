<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use Illuminate\Http\JsonResponse;

class TicketStatisticsController extends ApiController
{
    protected TicketRepository $tickets;

    public function __construct(TicketRepository $tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * @OA\Get(
     *     path="/api/tickets/statistics",
     *     summary="Get ticket statistics",
     *     description="Returns aggregated ticket statistics for the current day, week, and month.",
     *     operationId="getTicketStatistics",
     *     tags={"Tickets"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful statistics retrieval",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="daily",
     *                     type="integer",
     *                     example=12,
     *                     description="Number of tickets created in the last 24 hours"
     *                 ),
     *                 @OA\Property(
     *                     property="weekly",
     *                     type="integer",
     *                     example=54,
     *                     description="Number of tickets created in the last 7 days"
     *                 ),
     *                 @OA\Property(
     *                     property="monthly",
     *                     type="integer",
     *                     example=230,
     *                     description="Number of tickets created in the last 30 days"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unable to fetch ticket statistics.")
     *         )
     *     )
     * )
     */
    public function __invoke(): JsonResponse
    {
        $stats = $this->tickets->getStatistics();

            return $this->sendResponse(
                $stats,
                'Successful statistics retrieval!',
                200
            );
    }
}
