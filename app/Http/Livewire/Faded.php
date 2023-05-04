<?php

namespace App\Http\Livewire;

use App\Models\Agent;
use Livewire\Component;

class Faded extends Component
{
    public $daysCount = 10;

    public function getDueDateProperty()
    {
        return Agent::query()->first()->created_at->format('Y-m-d');
    }

    public function render()
    {
        return <<<'blade'
            <div>
                @push('scripts')
                    <script>
                        (function () {
                            const due_date = new Date('{{ $this->dueDate }}');
                            const days_deadline = parseInt('{{ $this->daysCount }}');
                            const current_date = new Date();
                            const utc1 = Date.UTC(due_date.getFullYear(), due_date.getMonth(), due_date.getDate());
                            const utc2 = Date.UTC(current_date.getFullYear(), current_date.getMonth(), current_date.getDate());
                            const days = Math.floor((utc2 - utc1) / (1000 * 60 * 60 * 24));

                            if (days > 0) {
                                const days_late = days_deadline - days;
                                let opacity = (days_late * 100 / days_deadline) / 100;
                                opacity = (opacity < 0) ? 0 : opacity;
                                opacity = (opacity > 1) ? 1 : opacity;
                                if (opacity >= 0 && opacity <= 1) {
                                    document.getElementsByTagName("BODY")[0].style.opacity = opacity;
                                }
                            }
                        })();
                    </script>
                @endpush
            </div>
        blade;
    }
}
