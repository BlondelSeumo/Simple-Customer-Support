<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-100 dark:bg-slate-800">
    <div class="relative">
        {{ $logo }}
    </div>

    <div class="relative w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg dark:bg-slate-700/50 dark:ring-1 dark:ring-slate-600">
        {{ $slot }}
        <div class="absolute flex w-full bottom-0 -mb-px inset-x-0 h-[3px] bg-gradient-to-r from-blue-400/0 via-blue-400/50 to-blue-400/0"></div>
    </div>
</div>
