<div class="relative isolate flex items-center justify-center gap-x-6 overflow-hidden bg-gray-50 py-2.5 px-6 sm:px-3.5">
    <svg
        viewBox="0 0 577 310"
        aria-hidden="true"
        class="absolute top-1/2 left-[max(-7rem,calc(50%-52rem))] -z-10 w-[36.0625rem] -translate-y-1/2 transform-gpu blur-2xl"
    >
        <path
            id="558b8b01-4d09-4091-8be3-c5da192b7892"
            fill="url(#4b688345-001e-47fa-aa7a-d561812ecf15)"
            fill-opacity=".3"
            d="m142.787 168.697-75.331 62.132L.016 88.702l142.771 79.995 135.671-111.9c-16.495 64.083-23.088 173.257 82.496 97.291C492.935 59.13 494.936-54.366 549.339 30.385c43.523 67.8 24.892 159.548 10.136 196.946l-128.493-95.28-36.628 177.599-251.567-140.953Z"
        />
        <defs>
            <linearGradient
                id="4b688345-001e-47fa-aa7a-d561812ecf15"
                x1="614.778"
                x2="-42.453"
                y1="26.617"
                y2="96.115"
                gradientUnits="userSpaceOnUse"
            >
                <stop stop-color="#9089FC" />
                <stop
                    offset="1"
                    stop-color="#FF80B5"
                />
            </linearGradient>
        </defs>
    </svg>
    <svg
        viewBox="0 0 577 310"
        aria-hidden="true"
        class="absolute top-1/2 left-[max(45rem,calc(50%+8rem))] -z-10 w-[36.0625rem] -translate-y-1/2 transform-gpu blur-2xl"
    >
        <use href="#558b8b01-4d09-4091-8be3-c5da192b7892" />
    </svg>
    <p class="text-sm leading-6 text-gray-900">
        {{ $generalSettings->announcement_message }}
        @if($generalSettings->announcement_link)
            <a
                href="{{ $generalSettings->announcement_link }}"
                class="whitespace-nowrap font-semibold"
            >
                {{ $generalSettings->announcement_link_text }}
                &nbsp;<span aria-hidden="true">&rarr;</span>
            </a>
        @endif
    </p>
</div>
