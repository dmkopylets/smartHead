<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\TicketStoreRequest;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;

class TicketController extends ApiController
{
    protected TicketService $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * @OA\Post(
     *     path="/api/tickets",
     *     summary="Create a new ticket",
     *     operationId="createTicket",
     *     tags={"Tickets"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Ticket data",
     *         @OA\JsonContent(
     *             required={"name", "phone", "email", "subject", "message"},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 maxLength=255,
     *                 example="John Doe",
     *                 description="Customer's full name"
     *             ),
     *             @OA\Property(
     *                 property="phone",
     *                 type="string",
     *                 pattern="^\+[1-9]\d{6,14}$",
     *                 example="+380991234567",
     *                 description="Phone number in E.164 format"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 maxLength=255,
     *                 example="john.doe@example.com",
     *                 description="Customer's email address"
     *             ),
     *             @OA\Property(
     *                 property="subject",
     *                 type="string",
     *                 maxLength=255,
     *                 example="Problem with my order",
     *                 description="Ticket subject or short title"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 maxLength=5000,
     *                 example="I have an issue with order #1234. The package hasn’t arrived yet.",
     *                 description="Detailed message from the customer"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ticket successfully created",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Application successfully created!"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 description="Created ticket data"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "phone": {"The phone format is invalid."}
     *                 }
     *             )
     *         )
     *     )
     * )
     */
    public function store(TicketStoreRequest $request): JsonResponse
     {
        $result = $this->ticketService->create($request->validated());

        return $this->sendResponse(
             $result,
             'Application successfully created!',
             201
         );
     }
 }
