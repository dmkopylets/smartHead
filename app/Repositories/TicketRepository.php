<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class TicketRepository
{
    public function getStatistics(): array
    {
        $now = Carbon::now();

        return [
            'daily' => $this->countByStatusSince($now->copy()->subDay()),
            'weekly' => $this->countByStatusSince($now->copy()->subWeek()),
            'monthly' => $this->countByStatusSince($now->copy()->subMonth()),
        ];
    }

    protected function countByStatusSince(Carbon $since): array
    {
        return Ticket::selectRaw('status, COUNT(*) as total')
            ->where('created_at', '>=', $since)
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
    }
}
