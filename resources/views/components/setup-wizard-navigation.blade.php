<nav aria-label="Progress">
    <ol
        role="list"
        class="flex items-center"
    >
        @foreach($steps as $step)
            <li
                @if ($step->isPrevious())
                    wire:click="{{ $step->show() }}"
                @endif
                class="relative {{ $loop->last ?: 'pr-8 sm:pr-20' }}"
            >
                <div
                    class="absolute inset-0 flex items-center"
                    aria-hidden="true"
                >
                    <div class="h-0.5 w-full {{ $step->isPrevious() ? 'bg-blue-600' : 'bg-slate-200' }}"></div>
                </div>
                <span class="relative cursor-pointer flex h-8 w-8 items-center justify-center rounded-full @if($step->isPrevious()) bg-blue-600 hover:bg-blue-900 @elseif($step->isCurrent()) border-2 border-blue-600 bg-white @else group border-2 border-slate-300 bg-white hover:border-slate-400 @endif">
                    @if($step->isPrevious())
                        <x-heroicon-m-check class="w-5 h-5 text-white" />
                    @elseif($step->isCurrent())
                        <span
                            class="h-2.5 w-2.5 rounded-full bg-blue-600"
                            aria-hidden="true"
                        ></span>
                    @else
                        <span
                            class="h-2.5 w-2.5 rounded-full bg-transparent group-hover:bg-slate-300"
                            aria-hidden="true"
                        ></span>
                    @endif
                    <span class="sr-only">{{ $step->label }}</span>
                </span>
            </li>
        @endforeach
    </ol>
</nav>
