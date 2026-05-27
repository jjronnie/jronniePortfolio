<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Services</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['services'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Projects</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['projects'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Skills</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['skills'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Messages</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['contacts'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Leads</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['leads'] }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Services by Type</h3>
                    <div id="services-chart"></div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Projects by Category</h3>
                    <div id="projects-chart"></div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Messages Over Time</h3>
                <div id="contacts-chart"></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const isDark = document.documentElement.classList.contains('dark');
                const textColor = isDark ? '#e5e7eb' : '#374151';
                const gridColor = isDark ? '#374151' : '#e5e7eb';

                const servicesByType = @json($stats['servicesByType']);
                const projectsByCategory = @json($stats['projectsByCategory']);
                const contactsByMonth = @json($stats['contactsByMonth']);

                if (Object.keys(servicesByType).length) {
                    new ApexCharts(document.querySelector('#services-chart'), {
                        chart: { type: 'donut', height: 250 },
                        labels: Object.keys(servicesByType),
                        series: Object.values(servicesByType),
                        colors: ['#6366f1', '#a855f7'],
                        theme: { mode: isDark ? 'dark' : 'light' },
                        responsive: [{ breakpoint: 480, options: { chart: { width: 200 }, legend: { position: 'bottom' } } }]
                    }).render();
                }

                if (Object.keys(projectsByCategory).length) {
                    new ApexCharts(document.querySelector('#projects-chart'), {
                        chart: { type: 'bar', height: 250, toolbar: { show: false } },
                        series: [{ name: 'Projects', data: Object.values(projectsByCategory) }],
                        xaxis: { categories: Object.keys(projectsByCategory), labels: { style: { colors: textColor } } },
                        yaxis: { labels: { style: { colors: textColor } } },
                        grid: { borderColor: gridColor },
                        theme: { mode: isDark ? 'dark' : 'light' },
                        colors: ['#6366f1'],
                    }).render();
                }

                if (Object.keys(contactsByMonth).length) {
                    new ApexCharts(document.querySelector('#contacts-chart'), {
                        chart: { type: 'area', height: 250, toolbar: { show: false } },
                        series: [{ name: 'Messages', data: Object.values(contactsByMonth) }],
                        xaxis: { categories: Object.keys(contactsByMonth), labels: { style: { colors: textColor } } },
                        yaxis: { labels: { style: { colors: textColor } } },
                        grid: { borderColor: gridColor },
                        theme: { mode: isDark ? 'dark' : 'light' },
                        colors: ['#22c55e'],
                        fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.3 } },
                    }).render();
                }
            });
        </script>
    @endpush
</x-app-layout>
