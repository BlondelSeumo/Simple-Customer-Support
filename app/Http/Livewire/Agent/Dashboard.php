<?php

namespace App\Http\Livewire\Agent;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DatePeriod;
use Livewire\Component;

class Dashboard extends Component
{
    public $periods = 7;

    public function getTotalTicketsCountProperty()
    {
        return $this->tickets->count();
    }

    public function getDailyTotalTicketsProperty()
    {
        $periods = new DatePeriod(Carbon::now()->subDays($this->periods)->startOfDay(), CarbonInterval::day(), Carbon::now()->endOfDay());

        $tickets = Ticket::query()
            ->whereBetween('created_at', [Carbon::now()->subDays($this->periods)->startOfDay(), Carbon::now()->endOfDay()])
            ->groupBy('day')
            ->orderBy('day')
            ->get([
                \DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day'),
                \DB::raw('count(*) as tickets_count'),
            ])
            ->keyBy('day')
            ->map(function ($item) {
                $item->date = Carbon::parse($item->date);
                return $item;
            });

        return array_map(function ($datePeriod) use ($tickets) {
            $date = $datePeriod->format('Y-m-d');
            return $tickets->has($date) ? $tickets->get($date)->tickets_count : 0;
        }, iterator_to_array($periods));
    }

    public function getOpenTicketsCountProperty()
    {
        return $this->tickets->where('status', TicketStatus::OPEN)->count();
    }

    public function getDailyOpenTicketsProperty()
    {
        $periods = new DatePeriod(Carbon::now()->subDays($this->periods)->startOfDay(), CarbonInterval::day(), Carbon::now()->endOfDay());

        $tickets = Ticket::query()
            ->where('status', TicketStatus::OPEN)
            ->whereBetween('created_at', [Carbon::now()->subDays($this->periods)->startOfDay(), Carbon::now()->endOfDay()])
            ->groupBy('day')
            ->orderBy('day')
            ->get([
                \DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day'),
                \DB::raw('count(*) as tickets_count'),
            ])
            ->keyBy('day')
            ->map(function ($item) {
                $item->date = Carbon::parse($item->date);
                return $item;
            });

        return array_map(function ($datePeriod) use ($tickets) {
            $date = $datePeriod->format('Y-m-d');
            return $tickets->has($date) ? $tickets->get($date)->tickets_count : 0;
        }, iterator_to_array($periods));
    }

    public function getPendingTicketsCountProperty()
    {
        return $this->tickets->where('status', TicketStatus::PENDING)->count();
    }

    public function getDailyPendingTicketsProperty()
    {
        $periods = new DatePeriod(Carbon::now()->subDays($this->periods)->startOfDay(), CarbonInterval::day(), Carbon::now()->endOfDay());

        $tickets = Ticket::query()
            ->where('status', TicketStatus::PENDING)
            ->whereBetween('created_at', [Carbon::now()->subDays($this->periods)->startOfDay(), Carbon::now()->endOfDay()])
            ->groupBy('day')
            ->orderBy('day')
            ->get([
                \DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day'),
                \DB::raw('count(*) as tickets_count'),
            ])
            ->keyBy('day')
            ->map(function ($item) {
                $item->date = Carbon::parse($item->date);
                return $item;
            });

        return array_map(function ($datePeriod) use ($tickets) {
            $date = $datePeriod->format('Y-m-d');
            return $tickets->has($date) ? $tickets->get($date)->tickets_count : 0;
        }, iterator_to_array($periods));
    }

    public function getSolvedTicketsCountProperty()
    {
        return $this->tickets->where('status', TicketStatus::SOLVED)->count();
    }

    public function getDailySolvedTicketsProperty()
    {
        $periods = new DatePeriod(Carbon::now()->subDays($this->periods)->startOfDay(), CarbonInterval::day(), Carbon::now()->endOfDay());

        $tickets = Ticket::query()
            ->where('status', TicketStatus::SOLVED)
            ->whereBetween('created_at', [Carbon::now()->subDays($this->periods)->startOfDay(), Carbon::now()->endOfDay()])
            ->groupBy('day')
            ->orderBy('day')
            ->get([
                \DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day'),
                \DB::raw('count(*) as tickets_count'),
            ])
            ->keyBy('day')
            ->map(function ($item) {
                $item->date = Carbon::parse($item->date);
                return $item;
            });

        return array_map(function ($datePeriod) use ($tickets) {
            $date = $datePeriod->format('Y-m-d');
            return $tickets->has($date) ? $tickets->get($date)->tickets_count : 0;
        }, iterator_to_array($periods));
    }

    public function getOpenAssignedTicketsRowProperty()
    {
        return Ticket::query()
            ->select('id', 'subject')
            ->where('status', TicketStatus::OPEN)
            ->whereHas('assignees', function ($query) {
                $query->where('agent_id', auth()->id());
            })
            ->orderByDesc('updated_at')
            ->get();
    }

    public function getTotalUsersCountProperty()
    {
        return $this->users->count();
    }

    public function getDailyTotalUsersProperty()
    {
        $periods = new DatePeriod(Carbon::now()->subDays($this->periods)->startOfDay(), CarbonInterval::day(), Carbon::now()->endOfDay());

        $users = User::query()
            ->whereBetween('created_at', [Carbon::now()->subDays($this->periods)->startOfDay(), Carbon::now()->endOfDay()])
            ->groupBy('day')
            ->orderBy('day')
            ->get([
                \DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day'),
                \DB::raw('count(*) as users_count'),
            ])
            ->keyBy('day')
            ->map(function ($item) {
                $item->date = Carbon::parse($item->date);
                return $item;
            });

        return array_map(function ($datePeriod) use ($users) {
            $date = $datePeriod->format('Y-m-d');
            return $users->has($date) ? $users->get($date)->users_count : 0;
        }, iterator_to_array($periods));
    }

    public function getTicketsProperty()
    {
        return Ticket::query()
            ->select('id', 'status')
            ->whereBetween('created_at', [Carbon::now()->subDays($this->periods)->startOfDay(), Carbon::now()->endOfDay()])
            ->get();
    }

    public function getUsersProperty()
    {
        return User::query()
            ->select('id')
            ->whereBetween('created_at', [Carbon::now()->subDays($this->periods)->startOfDay(), Carbon::now()->endOfDay()])
            ->get();
    }

    public function render()
    {
        return view('livewire.agent.dashboard');
    }
}
