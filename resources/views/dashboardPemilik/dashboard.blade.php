<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik | SIP-KBI</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'sipkbi-green': '#16a34a',
                        'sipkbi-dark': '#064e3b',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition duration-500">

    <div class="p-5 border-t  border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h1 class="font-bold text-lg text-sipkbi-green">SIP-KBI</h1>
    <div class="flex gap-5 items-center justify-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-500 hover:underline text-sm">Keluar</button>
        </form>
        <button id="theme-toggle"
            class="px-3 py-2 border rounded-md text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">
            🌞
        </button>
    </div>
    </div>
        <!-- Konten Utama -->
        <main class="flex-1 p-8 overflow-y-auto h-screen">
            <h2 class="text-2xl font-bold mb-4">Dashboard Utama</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                Pantau pendapatan dan pengeluaran harian Anda
            </p>

            <!-- Kartu Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pendapatan</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pengeluaran</h3>
                    <p class="text-3xl font-bold text-red-600 mt-2">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Saldo</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                </div>
            </div>

             <!-- Filter Bulan -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 gap-4">
                <h3 class="text-lg font-semibold text-sipkbi-green">Grafik Keuangan</h3>
                <select id="month-filter" class="border border-gray-300 dark:border-gray-700 rounded-lg p-2 bg-white dark:bg-gray-800">
                    <option value="all">Semua Bulan</option>
                    @foreach ($availableMonths as $month)
                        <option value="{{ $month }}">{{ \Carbon\Carbon::parse($month . '-01')->translatedFormat('F Y') }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Chart Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <h3 class="text-lg font-semibold mb-4 text-green-600">Grafik Pemasukan</h3>
                    <canvas id="chartPemasukan"></canvas>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <h3 class="text-lg font-semibold mb-4 text-red-500">Grafik Pengeluaran</h3>
                    <canvas id="chartPengeluaran"></canvas>
                </div>
            </div>

            <!-- Chart Budidaya Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Grafik Bibit -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <h3 class="text-lg font-semibold mb-4 text-blue-500">Grafik Jumlah Bibit</h3>
                    <canvas id="chartBibit"></canvas>
                </div>

                <!-- Grafik Ikan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <h3 class="text-lg font-semibold mb-4 text-teal-500">Grafik Jumlah Ikan</h3>
                    <canvas id="chartIkan"></canvas>
                </div>
            </div>

            <!-- Tabel Riwayat Transaksi -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4">Riwayat Transaksi</h3>

                <!-- Wrapper agar tabel bisa di-scroll di layar kecil -->
                <div class="overflow-x-auto">
                    <table class="min-w-[600px] w-full text-sm border-collapse">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="py-2 px-3 text-left">Tanggal</th>
                                <th class="py-2 px-3 text-left">Tipe</th>
                                <th class="py-2 px-3 text-left">Kategori</th>
                                <th class="py-2 px-3 text-left">Deskripsi</th>
                                <th class="py-2 px-3 text-right">Jumlah (Rp)</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($latestTransactions as $item)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="py-2 px-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                    <td class="py-2 px-3">{{ $item->jenis }}</td>
                                    <td class="py-2 px-3">
                                        @if ($item->jenis == 'pemasukan')
                                            <span class="text-green-600 font-medium">Pemasukan</span>
                                        @else
                                            <span class="text-red-500 font-medium">Pengeluaran</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-3">{{ $item->keterangan }}</td>
                                    <td class="py-2 px-3 text-right {{ $item->jenis == 'pemasukan' ? 'text-green-600' : 'text-red-500' }}">
                                        {{ $item->jenis == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    <script>
        // === SIDEBAR TOGGLE ===
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebarContainer = document.getElementById('sidebar-container');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        sidebarToggle?.addEventListener('click', () => {
            sidebarContainer.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        });

        sidebarClose?.addEventListener('click', () => {
            sidebarContainer.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        sidebarOverlay?.addEventListener('click', () => {
            sidebarContainer.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        // === DARK MODE ===
        const toggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
            toggle.textContent = '🌙';
        } else {
            html.classList.remove('dark');
            toggle.textContent = '🌞';
        }
        toggle?.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            toggle.textContent = isDark ? '🌙' : '🌞';
            localStorage.theme = isDark ? 'dark' : 'light';
        });

        // === CHART DATA ===
        const labels = @json($labels); // Sudah diformat (misal: "05 Okt")
        const tanggalAsli = @json($tanggalAsli); // Format YYYY-MM-DD dari controller
        const dataPemasukan = @json($dataPemasukan);
        const dataPengeluaran = @json($dataPengeluaran);
        const dataBibit = @json($dataBibit);
        const dataIkan = @json($dataIkan);


        // === CHART INITIALIZATION ===
        const ctxPemasukan = document.getElementById('chartPemasukan').getContext('2d');
        const ctxPengeluaran = document.getElementById('chartPengeluaran').getContext('2d');

        const chartPemasukan = new Chart(ctxPemasukan, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pemasukan (Rp)',
                    data: dataPemasukan,
                    borderColor: '#16a34a',
                    backgroundColor: 'rgba(22,163,74,0.2)',
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: { responsive: true }
        });

        const chartPengeluaran = new Chart(ctxPengeluaran, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pengeluaran (Rp)',
                    data: dataPengeluaran,
                    borderColor: '#dc2626',
                    backgroundColor: 'rgba(220,38,38,0.2)',
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: { responsive: true }
        });

        // === CHART BUDIDAYA ===
        const ctxBibit = document.getElementById('chartBibit').getContext('2d');
        const ctxIkan = document.getElementById('chartIkan').getContext('2d');

        const chartBibit = new Chart(ctxBibit, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Bibit (ekor)',
                    data: dataBibit,
                    backgroundColor: 'rgba(59,130,246,0.5)', // biru lembut
                    borderColor: '#3b82f6',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Ekor' } }
                }
            }
        });

        const chartIkan = new Chart(ctxIkan, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Ikan (ekor)',
                    data: dataIkan,
                    backgroundColor: 'rgba(20,184,166,0.5)', // teal lembut
                    borderColor: '#14b8a6',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Ekor' } }
                }
            }
        });


        // === FILTER BULAN ===
        document.getElementById('month-filter').addEventListener('change', (e) => {
            const selectedMonth = e.target.value; // format: YYYY-MM
            if (selectedMonth === 'all') {
                updateCharts(labels, dataPemasukan, dataPengeluaran);
            } else {
                const filteredLabels = [];
                const filteredPemasukan = [];
                const filteredPengeluaran = [];
                const filteredBibit = [];
                const filteredIkan = [];

                tanggalAsli.forEach((tgl, i) => {
                    if (tgl.startsWith(selectedMonth)) {
                        filteredLabels.push(labels[i]);
                        filteredPemasukan.push(dataPemasukan[i]);
                        filteredPengeluaran.push(dataPengeluaran[i]);
                        filteredBibit.push(dataBibit[i]);
                        filteredIkan.push(dataIkan[i]);
                    }
                });

                updateCharts(filteredLabels, filteredPemasukan, filteredPengeluaran, filteredBibit, filteredIkan);

            }
        });

        // === UPDATE CHART FUNCTION ===
        function updateCharts(newLabels, newPemasukan, newPengeluaran, newBibit = dataBibit, newIkan = dataIkan) {
        chartPemasukan.data.labels = newLabels;
        chartPemasukan.data.datasets[0].data = newPemasukan;
        chartPemasukan.update();

        chartPengeluaran.data.labels = newLabels;
        chartPengeluaran.data.datasets[0].data = newPengeluaran;
        chartPengeluaran.update();

        chartBibit.data.labels = newLabels;
        chartBibit.data.datasets[0].data = newBibit;
        chartBibit.update();

        chartIkan.data.labels = newLabels;
        chartIkan.data.datasets[0].data = newIkan;
        chartIkan.update();
    }

    </script>
</body>
</html>
