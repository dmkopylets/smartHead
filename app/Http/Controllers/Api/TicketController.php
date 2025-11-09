<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketStoreRequest;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    protected TicketService $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function store(TicketStoreRequest $request): JsonResponse
    {
        $result = $this->ticketService->create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Application successfully created!',
            'data' => $result,
        ], 201);
    }
}
