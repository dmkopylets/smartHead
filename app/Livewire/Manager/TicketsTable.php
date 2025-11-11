<?php

namespace App\Livewire\Manager;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Ticket;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TicketsTable extends DataTableComponent
{
    protected $model = Ticket::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableWrapperAttributes([
            'class' => 'overflow-hidden rounded-xl shadow',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable()->searchable(),
            Column::make('Customer', 'customer_id')
                ->format(fn($value, $row) => optional($row->customer)->name ?? '—')
                ->sortable(),
            Column::make('Subject', 'subject')->sortable()->searchable(),
            Column::make('Message', 'message')
                ->format(fn($value) => Str::limit($value, 50)),
            Column::make('Status', 'status')->sortable(),
            Column::make('Manager replied at', 'manager_replied_at')
                ->format(fn($value) => $value
                    ? Carbon::parse($value)->format('d.m.Y H:i')
                    : '-'
                )
                ->sortable(),
            Column::make('Actions')
                ->label(fn($row) => view('dashboard.manager.partials.actions', compact('row')))
                ->html(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options([
                    '' => 'All',
                    'new' => 'New',
                    'in_process' => 'in process',
                    'оброблений' => 'Оброблений',
                ])
                ->filter(fn($query, $value) => $query->where('status', $value)),
        ];
    }

}
