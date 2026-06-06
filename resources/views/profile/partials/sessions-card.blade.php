<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="max-w-xl">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Active Sessions') }}
        </h3>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Manage your active sessions on other browsers and devices.') }}
        </p>

        <div class="mt-6 space-y-4">
            @foreach ($sessions as $session)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="shrink-0">
                            @if ($session->user_agent)
                                @php
                                    $platform = 'unknown';
                                    $browser = 'unknown';
                                    $ua = $session->user_agent;
                                    if (str_contains($ua, 'Windows')) { $platform = 'Windows'; }
                                    elseif (str_contains($ua, 'Mac OS')) { $platform = 'macOS'; }
                                    elseif (str_contains($ua, 'Linux')) { $platform = 'Linux'; }
                                    elseif (str_contains($ua, 'Android')) { $platform = 'Android'; }
                                    elseif (str_contains($ua, 'iOS') || str_contains($ua, 'iPhone') || str_contains($ua, 'iPad')) { $platform = 'iOS'; }
                                    if (str_contains($ua, 'Firefox')) { $browser = 'Firefox'; }
                                    elseif (str_contains($ua, 'Chrome')) { $browser = 'Chrome'; }
                                    elseif (str_contains($ua, 'Safari')) { $browser = 'Safari'; }
                                    elseif (str_contains($ua, 'Edge')) { $browser = 'Edge'; }
                                @endphp
                                <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @else
                                <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $browser }} on {{ $platform }}
                                @if ($session->id === session()->getId())
                                    <span class="text-xs text-green-600 dark:text-green-400 font-semibold">({{ __('Current') }})</span>
                                @endif
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $session->ip_address }}
                                &middot;
                                {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
