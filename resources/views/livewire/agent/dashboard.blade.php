<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-4">
            <div>
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium leading-6 text-slate-900 dark:text-slate-200">
                        {{ __('Last :count days', ['count' => $periods]) }}
                    </h3>
                    <x-dropdown width="full">
                        <x-slot name="trigger">
                            <x-button.secondary>
                                {{ __('Last :count days', ['count' => $periods]) }}
                                <x-heroicon-s-chevron-down class="ml-2 -mr-1 h-5 w-5" />
                            </x-button.secondary>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link
                                role="button"
                                wire:click="$set('periods', 7)"
                            >
                                {{ __('Last :count days', ['count' => 7]) }}
                            </x-dropdown-link>
                            <x-dropdown-link
                                role="button"
                                wire:click="$set('periods', 10)"
                            >
                                {{ __('Last :count days', ['count' => 10]) }}
                            </x-dropdown-link>
                            <x-dropdown-link
                                role="button"
                                wire:click="$set('periods', 30)"
                            >
                                {{ __('Last :count days', ['count' => 30]) }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <div class="sm:grid-cols-1 space-y-5">
                        <x-card class="relative overflow-hidden rounded-lg">
                            <x-slot:content>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="truncate text-sm font-medium text-slate-500 dark:text-slate-200">{{ __('Tickets') }}</div>
                                        <div class="mt-1 text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-200">{{ $this->total_tickets_count }}</div>
                                    </div>
                                    <div
                                        x-data="{
                                        init() {
                                            new ApexCharts($refs.chartElement, {
                                                series: [{
                                                    name: 'Tickets',
                                                    data: @json($this->daily_total_tickets)
                                                }],
                                                chart: {
                                                    type: 'bar',
                                                    width: 100,
                                                    height: 46,
                                                    sparkline: {
                                                        enabled: true,
                                                    }
                                                },
                                                colors: ['#3b82f6'],
                                                plotOptions: {
                                                    bar: {
                                                        columnWidth: '80%',
                                                    }
                                                },
                                                xaxis: {
                                                    crosshairs: {
                                                        width: 1,
                                                    },
                                                },
                                                tooltip: {
                                                    fixed: {
                                                        enabled: false,
                                                    },
                                                    x: {
                                                        show: false,
                                                    },
                                                    y: {
                                                        title: {
                                                            formatter: function (seriesName) {
                                                                return '';
                                                            }
                                                        }
                                                    },
                                                    marker: {
                                                        show: false,
                                                    }
                                                }
                                            }).render();
                                        }
                                    }"
                                        class="md:hidden lg:block"
                                    >
                                        <div x-ref="chartElement"></div>
                                    </div>
                                </div>
                            </x-slot:content>
                        </x-card>

                        <x-card class="relative overflow-hidden rounded-lg">
                            <x-slot:content>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="truncate text-sm font-medium text-slate-500 dark:text-slate-200">{{ __('Open') }}</div>
                                        <div class="mt-1 text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-200">{{ $this->open_tickets_count }}</div>
                                    </div>
                                    <div
                                        x-data="{
                                        init() {
                                            new ApexCharts($refs.chartElement, {
                                                series: [{
                                                    name: 'Tickets',
                                                    data: @json($this->daily_open_tickets)
                                                }],
                                                chart: {
                                                    type: 'bar',
                                                    width: 100,
                                                    height: 46,
                                                    sparkline: {
                                                        enabled: true,
                                                    }
                                                },
                                                colors: ['#3b82f6'],
                                                plotOptions: {
                                                    bar: {
                                                        columnWidth: '80%',
                                                    }
                                                },
                                                xaxis: {
                                                    crosshairs: {
                                                        width: 1,
                                                    },
                                                },
                                                tooltip: {
                                                    fixed: {
                                                        enabled: false,
                                                    },
                                                    x: {
                                                        show: false,
                                                    },
                                                    y: {
                                                        title: {
                                                            formatter: function (seriesName) {
                                                                return '';
                                                            }
                                                        }
                                                    },
                                                    marker: {
                                                        show: false,
                                                    }
                                                }
                                            }).render();
                                        }
                                    }"
                                        class="md:hidden lg:block"
                                    >
                                        <div x-ref="chartElement"></div>
                                    </div>
                                </div>
                            </x-slot:content>
                        </x-card>

                        <x-card class="relative overflow-hidden rounded-lg">
                            <x-slot:content>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="truncate text-sm font-medium text-slate-500 dark:text-slate-200">{{ __('Pending') }}</div>
                                        <div class="mt-1 text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-200">{{ $this->pending_tickets_count }}</div>
                                    </div>
                                    <div
                                        x-data="{
                                        init() {
                                            new ApexCharts($refs.chartElement, {
                                                series: [{
                                                    name: 'Tickets',
                                                    data: @json($this->daily_pending_tickets)
                                                }],
                                                chart: {
                                                    type: 'bar',
                                                    width: 100,
                                                    height: 46,
                                                    sparkline: {
                                                        enabled: true,
                                                    }
                                                },
                                                colors: ['#3b82f6'],
                                                plotOptions: {
                                                    bar: {
                                                        columnWidth: '80%',
                                                    }
                                                },
                                                xaxis: {
                                                    crosshairs: {
                                                        width: 1,
                                                    },
                                                },
                                                tooltip: {
                                                    fixed: {
                                                        enabled: false,
                                                    },
                                                    x: {
                                                        show: false,
                                                    },
                                                    y: {
                                                        title: {
                                                            formatter: function (seriesName) {
                                                                return '';
                                                            }
                                                        }
                                                    },
                                                    marker: {
                                                        show: false,
                                                    }
                                                }
                                            }).render();
                                        }
                                    }"
                                        class="md:hidden lg:block"
                                    >
                                        <div x-ref="chartElement"></div>
                                    </div>
                                </div>
                            </x-slot:content>
                        </x-card>

                        <x-card class="relative overflow-hidden rounded-lg">
                            <x-slot:content>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="truncate text-sm font-medium text-slate-500 dark:text-slate-200">{{ __('Solved') }}</div>
                                        <div class="mt-1 text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-200">{{ $this->solved_tickets_count }}</div>
                                    </div>
                                    <div
                                        x-data="{
                                        init() {
                                            new ApexCharts($refs.chartElement, {
                                                series: [{
                                                    name: 'Tickets',
                                                    data: @json($this->daily_solved_tickets)
                                                }],
                                                chart: {
                                                    type: 'bar',
                                                    width: 100,
                                                    height: 46,
                                                    sparkline: {
                                                        enabled: true,
                                                    }
                                                },
                                                colors: ['#3b82f6'],
                                                plotOptions: {
                                                    bar: {
                                                        columnWidth: '80%',
                                                    }
                                                },
                                                xaxis: {
                                                    crosshairs: {
                                                        width: 1,
                                                    },
                                                },
                                                tooltip: {
                                                    fixed: {
                                                        enabled: false,
                                                    },
                                                    x: {
                                                        show: false,
                                                    },
                                                    y: {
                                                        title: {
                                                            formatter: function (seriesName) {
                                                                return '';
                                                            }
                                                        }
                                                    },
                                                    marker: {
                                                        show: false,
                                                    }
                                                }
                                            }).render();
                                        }
                                    }"
                                        class="md:hidden lg:block"
                                    >
                                        <div x-ref="chartElement"></div>
                                    </div>
                                </div>
                            </x-slot:content>
                        </x-card>

                        <x-card class="relative overflow-hidden rounded-lg">
                            <x-slot:content>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="truncate text-sm font-medium text-slate-500 dark:text-slate-200">{{ __('Users') }}</div>
                                        <div class="mt-1 text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-200">{{ $this->total_users_count }}</div>
                                    </div>
                                    <div
                                        x-data="{
                                        init() {
                                            new ApexCharts($refs.chartElement, {
                                                series: [{
                                                    name: 'Tickets',
                                                    data: @json($this->daily_total_users)
                                                }],
                                                chart: {
                                                    type: 'bar',
                                                    width: 100,
                                                    height: 46,
                                                    sparkline: {
                                                        enabled: true,
                                                    }
                                                },
                                                colors: ['#3b82f6'],
                                                plotOptions: {
                                                    bar: {
                                                        columnWidth: '80%',
                                                    }
                                                },
                                                xaxis: {
                                                    crosshairs: {
                                                        width: 1,
                                                    },
                                                },
                                                tooltip: {
                                                    fixed: {
                                                        enabled: false,
                                                    },
                                                    x: {
                                                        show: false,
                                                    },
                                                    y: {
                                                        title: {
                                                            formatter: function (seriesName) {
                                                                return '';
                                                            }
                                                        }
                                                    },
                                                    marker: {
                                                        show: false,
                                                    }
                                                }
                                            }).render();
                                        }
                                    }"
                                        class="md:hidden lg:block"
                                    >
                                        <div x-ref="chartElement"></div>
                                    </div>
                                </div>
                            </x-slot:content>
                        </x-card>
                    </div>
                    <div class="sm:col-span-2">
                        <x-card class="relative overflow-hidden rounded-lg h-full">
                            <x-slot:header>
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-display leading-6 text-slate-900 dark:text-slate-200">
                                        {{ trans_choice('Your open ticket (:count)|Your open tickets (:count)', $this->open_assigned_tickets_row->count()) }}
                                    </h3>
                                    <a
                                        href="{{ route('agent.tickets.list', ['status' => 'open']) }}"
                                        class="ml-3 flex-shrink-0 text-sm text-blue-600 hover:text-blue-500 dark:text-slate-300 dark:hover:text-slate-200"
                                    >
                                        {{ __('View all') }}
                                    </a>
                                </div>
                            </x-slot:header>
                            <x-slot:content>
                                @if($this->open_assigned_tickets_row->count())
                                    <div class="-mx-4 -my-6 overflow-x-auto sm:-mx-6">
                                        <div class="inline-block min-w-full align-middle">
                                            <table class="min-w-full divide-y divide-slate-300 dark:divide-slate-600">
                                                <thead class="bg-slate-50 dark:bg-slate-700">
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6 dark:text-slate-200"
                                                        >
                                                            #
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="py-3.5 px-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-200"
                                                        >
                                                            {{ __('Subject') }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-slate-300 dark:divide-slate-600">
                                                    @foreach($this->open_assigned_tickets_row->take(10) as $ticket)
                                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/25">
                                                            <td class="whitespace-nowrap py-3.5 pl-4 pr-3 text-sm text-slate-700 sm:pl-6 dark:text-slate-200">
                                                                {{ $ticket->id }}
                                                            </td>
                                                            <td class="whitespace-nowrap py-3.5 px-3 text-sm font-medium text-slate-900 dark:text-slate-200">
                                                                <a
                                                                    href="{{ route('agent.tickets.details', $ticket) }}"
                                                                    class="hover:text-blue-500 hover:underline dark:hover:text-blue-400"
                                                                >
                                                                    {{ $ticket->subject }}
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center">
                                        <h4 class="text-sm font-medium text-slate-900 dark:text-slate-200">
                                            {!! __('&#127881; Woohoo!') !!}
                                        </h4>
                                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                            {{ __('It looks like you don\'t have any open tickets, enjoy your spare time!') }}
                                        </p>
                                    </div>
                                @endif
                            </x-slot:content>
                        </x-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
