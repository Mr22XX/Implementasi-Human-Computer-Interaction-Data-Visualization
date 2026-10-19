<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budidaya | SIP-KBI</title>

    <!-- Tailwind + Chart.js + jQuery -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jQuery (harus pertama) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables Core + Tailwind CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.min.css">
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <!-- Buttons Extension -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.tailwindcss.min.css">
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

    <!-- Export dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>



    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <style>
          /* === DataTable Styling === */
    table.dataTable {
        border-collapse: collapse !important;
        width: 100% !important;
    }

    /* Header */
    table.dataTable thead th {
        background-color: #16a34a !important;
        color: white !important;
        font-weight: 600;
        text-transform: uppercase;
        padding: 12px;
    }

    /* Rows */
    table.dataTable tbody tr {
        transition: background-color 0.2s ease-in-out;
    }
    table.dataTable tbody tr:hover {
        background-color: rgba(22, 163, 74, 0.08);
    }

    /* Dark mode table */
    html.dark table.dataTable thead th {
        background-color: #15803d !important;
    }
    html.dark table.dataTable tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.08);
    }
    html.dark table.dataTable tbody td {
        color: #e5e7eb !important;
    }

    /* Search bar & length selector */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 6px 10px;
        background-color: #fff;
        color: #111827;
        transition: all 0.2s ease;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #16a34a;
        box-shadow: 0 0 0 2px rgba(22, 163, 74, 0.25);
        outline: none;
    }
    html.dark .dataTables_wrapper .dataTables_filter input {
        background-color: #1f2937;
        color: #f9fafb;
        border-color: #374151;
    }

    /* Pagination buttons */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 0.5rem !important;
        border: none !important;
        background-color: #e5e7eb !important;
        color: #111827 !important;
        margin: 0 2px;
        transition: all 0.2s ease;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #16a34a !important;
        color: white !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #16a34a !important;
        color: white !important;
        font-weight: bold;
    }
    html.dark .dataTables_wrapper .dataTables_paginate .paginate_button {
        background-color: #374151 !important;
        color: #f3f4f6 !important;
    }
    html.dark .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #16a34a !important;
        color: white !important;
    }

    /* Length dropdown */
    .dataTables_wrapper .dataTables_length select {
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        padding: 6px 10px;
        background-color: #fff;
        color: #111827;
    }
    html.dark .dataTables_wrapper .dataTables_length select {
        background-color: #1f2937;
        color: #f9fafb;
        border-color: #374151;
    }

    /* Info text */
    .dataTables_wrapper .dataTables_info {
        color: #6b7280;
    }
    html.dark .dataTables_wrapper .dataTables_info {
        color: #9ca3af;
    }

    .dataTables_wrapper {
    color: inherit;
    font-size: 0.95rem;
}

    /* Search box & length dropdown */
    .dataTables_filter label,
    .dataTables_length label {
        color: inherit !important;
        font-weight: 500;
    }

    .dataTables_filter input {
        background-color: rgb(31 41 55 / var(--tw-bg-opacity));
        color: white;
        border-radius: 0.5rem;
        padding: 0.4rem 0.8rem;
        border: 1px solid #4b5563;
        margin-left: 0.5rem;
        transition: all 0.2s ease;
    }

    .dataTables_filter input:focus {
        border-color: #22c55e;
        outline: none;
        box-shadow: 0 0 0 2px #22c55e40;
    }

    .dataTables_length select {
        background-color: rgb(31 41 55 / var(--tw-bg-opacity));
        color: white;
        border-radius: 0.5rem;
        padding: 0.4rem;
        border: 1px solid #4b5563;
    }

    /* Pagination */
    .dataTables_paginate {
        margin-top: 1rem;
        display: flex;
        justify-content: center;
        gap: 0.25rem;
    }

    .dataTables_paginate .paginate_button {
        background-color: rgb(31 41 55 / var(--tw-bg-opacity));
        color: white !important;
        border: 1px solid #4b5563;
        padding: 0.4rem 0.7rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .dataTables_paginate .paginate_button:hover {
        background-color: #22c55e;
        border-color: #22c55e;
        color: white !important;
    }

    .dataTables_paginate .paginate_button.current {
        background-color: #16a34a !important;
        color: white !important;
        border: 1px solid #16a34a;
    }

    /* Info text */
    .dataTables_info {
        color: inherit;
        margin-top: 1rem;
    }

    /* Table cells & header */
    table.dataTable thead {
        background-color: rgb(55 65 81 / var(--tw-bg-opacity));
        color: white;
    }

    table.dataTable tbody tr:hover {
        background-color: rgb(75 85 99 / 0.3);
    }

    
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition duration-500">
   <!-- Navbar Mobile -->
    <header class="md:hidden flex items-center justify-between bg-white dark:bg-gray-800 shadow p-4">
        <button id="sidebar-toggle" class="text-2xl">☰</button>
        <h1 class="font-bold text-sipkbi-green">SIP-KBI</h1>
    </header>

    <!-- Overlay (gelap di belakang sidebar, hanya tampil di mobile) -->
    <div id="sidebar-overlay" 
         class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

    <!-- Layout -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div id="sidebar-container"
            class="fixed md:relative inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-md transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-40">
            
            <!-- Tombol X hanya tampil di mobile -->
            <div class="md:hidden flex justify-end p-4">
                <button id="sidebar-close" class="text-2xl text-gray-500 hover:text-gray-700 dark:text-gray-300">✕</button>
            </div>

            @include('layouts.sidebar')
        </div>

        <!-- Konten Utama -->
        <main class="flex-1 p-8 overflow-y-auto h-screen">
            <h2 class="text-2xl font-bold mb-4">Manajemen Budidaya</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Kelola dan pantau transaksi Data Budidaya</p>

            <!-- Kartu Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Kolam</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ number_format($totalKolam, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Bibit</h3>
                    <p class="text-3xl font-bold text-red-600 mt-2">{{ number_format($totalBibit, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
                    <h3 class="text-sm text-gray-500 dark:text-gray-400">Kolam Aktif</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ number_format($aktif, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Tombol Tambah -->
            <div class="mb-4">
                <button id="openAddModal" class="bg-sipkbi-green text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
                    + Tambah Data
                </button>
            </div>

            <!-- Tabel Keuangan -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md overflow-x-auto">
                <table id="tabelBudidaya" class="display w-full text-sm text-gray-800 dark:text-gray-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kolam</th>
                            <th>Jenis Ikan</th>
                            <th>Tanggal Tebar</th>
                            <th>Jumlah Bibit</th>
                            <th>Pakan Per Hari</th>
                            <th>Umur Ikan</th>
                            <th>Perkiraan Panen</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budidaya as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ ($item->nama_kolam) }}</td>
                                <td>
                                    {{$item->jenis_ikan}}
                                </td>
                                <td>{{ $item->tanggal_tebar }}</td>
                                <td>{{ $item->jumlah_bibit }}</td>
                                <td>{{ $item->pakan_perhari }}</td>
                                <td>{{ $item->umur_ikan }}</td>
                                <td>{{ $item->perkiraan_panen }}</td>
                                <td>
                                    <span class="px-2 py-1 rounded {{ strtolower($item->status) == 'aktif' ? 'bg-green-200 text-green-800' : 'bg-blue-200 text-blue-800' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td class="text-center space-x-2">
                                    <button class="editBtn bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md"
                                        data-id="{{ $item->id_budidaya }}"
                                        data-nama_kolam="{{ $item->nama_kolam }}"
                                        data-jenis_ikan="{{ $item->jenis_ikan }}"
                                        data-tanggal_tebar="{{ $item->tanggal_tebar }}"
                                        data-jumlah_bibit="{{ $item->jumlah_bibit }}"
                                        data-pakan_perhari="{{ $item->pakan_perhari }}"
                                        data-perkiraan_panen="{{ $item->perkiraan_panen }}"
                                        data-status="{{ $item->status }}"
                                        data-keterangan="{{ $item->keterangan }}">
                                        Edit
                                    </button>


                                    <button type="button" data-id="{{ $item->id_budidaya }}" 
                                            class="deleteBtn bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md">
                                            Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

<!-- Modal Tambah/Edit -->
<div id="modalForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-96 p-6">
        <h3 id="modalTitle" class="text-lg font-bold mb-4 text-sipkbi-green">Tambah Data Budidaya</h3>
        <form id="formBudidaya" method="POST">
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">

            <label class="block mb-2 text-sm">Nama Kolam</label>
            <input type="text" name="nama_kolam" id="nama_kolam" class="w-full border border-gray-300 rounded-lg p-2 mb-3 dark:bg-gray-700">

            <label class="block mb-2 text-sm">Jenis Ikan</label>
            <input type="text" name="jenis_ikan" id="jenis_ikan" class="w-full border border-gray-300 rounded-lg p-2 mb-3 dark:bg-gray-700">

            <label class="block mb-2 text-sm">Tanggal Tebar</label>
            <input type="date" name="tanggal_tebar" id="tanggal_tebar" class="w-full border border-gray-300 rounded-lg p-2 mb-3 dark:bg-gray-700">

            <label class="block mb-2 text-sm">Jumlah Bibit</label>
            <input type="number" name="jumlah_bibit" id="jumlah_bibit" class="w-full border border-gray-300 rounded-lg p-2 mb-3 dark:bg-gray-700">

            <label class="block mb-2 text-sm">Pakan per Hari (Kg)</label>
            <input type="number" step="0.01" name="pakan_perhari" id="pakan_perhari" class="w-full border border-gray-300 rounded-lg p-2 mb-3 dark:bg-gray-700">

            <label class="block mb-2 text-sm">Perkiraan Panen</label>
            <input type="date" name="perkiraan_panen" id="perkiraan_panen" class="w-full border border-gray-300 rounded-lg p-2 mb-3 dark:bg-gray-700">

            <label class="block mb-2 text-sm">Status</label>
            <select name="status" id="status" class="w-full border border-gray-300 rounded-lg p-2 mb-3 dark:bg-gray-700">
                <option value="aktif">Aktif</option>
                <option value="selesai">Selesai</option>
            </select>

            <label class="block mb-2 text-sm">Keterangan</label>
            <textarea name="keterangan" id="keterangan" rows="2" class="w-full border border-gray-300 rounded-lg p-2 mb-4 dark:bg-gray-700"></textarea>

            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModal" class="bg-gray-400 text-white px-3 py-2 rounded-md hover:bg-gray-500">Batal</button>
                <button type="submit" class="bg-sipkbi-green text-white px-3 py-2 rounded-md hover:bg-green-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

    <!-- Script -->
    <script>
$(document).ready(function () {
    const table = $('#tabelBudidaya').DataTable({
        responsive: true,
        dom: '<"flex flex-wrap justify-between items-center mb-4"Bf>rt<"flex justify-between items-center mt-4"lp>',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel mr-2"></i> Excel',
                className: 'bg-green-600 text-white px-3 py-1 rounded-md hover:bg-green-700 transition',
                title: 'Data Budidaya',
                exportOptions: { columns: [0, 1, 2, 3, 4] }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa-solid fa-file-pdf mr-2"></i> PDF',
                className: 'bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition',
                title: 'Data Budidaya',
                exportOptions: { columns: [0, 1, 2, 3, 4] }
            },
            {
                extend: 'csvHtml5',
                text: '<i class="fa-solid fa-file-csv mr-2"></i> CSV',
                className: 'bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition',
                title: 'Data Budidaya',
                exportOptions: { columns: [0, 1, 2, 3, 4] }
            },
            {
                extend: 'print',
                text: '<i class="fa-solid fa-print mr-2"></i> Print',
                className: 'bg-gray-600 text-white px-3 py-1 rounded-md hover:bg-gray-700 transition',
                title: 'Data Budidaya',
                exportOptions: { columns: [0, 1, 2, 3, 4] }
            }
        ],
        language: {
            search: "Cari:",
            lengthMenu: "_MENU_ data per halaman",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            zeroRecords: "Tidak ada data ditemukan",
            infoEmpty: "Tidak ada data tersedia"
        }
    });

    // Tombol export muncul di atas tabel (posisi filter)
    table.buttons().container()
        .appendTo('#tabelBudidaya_wrapper .dataTables_filter');
});


        // === Modal ===
    const modal = $('#modalForm');
    const form = $('#formBudidaya');
    const modalTitle = $('#modalTitle');
    const methodInput = $('#formMethod');

       $('#openAddModal').on('click', () => {
        modalTitle.text('Tambah Data Budidaya');
        form.attr('action', '{{ route('budidaya.store') }}');
        methodInput.val('POST');
        form[0].reset();
        modal.removeClass('hidden');
    });


 $('.editBtn').on('click', function() {
        const data = $(this).data();
        modalTitle.text('Edit Data Budidaya');
        form.attr('action', '/user/budidaya/' + data.id);
        methodInput.val('PUT');

        // isi form dengan data dari tombol edit
        $('#nama_kolam').val(data.nama_kolam);
        $('#jenis_ikan').val(data.jenis_ikan);
        $('#tanggal_tebar').val(data.tanggal_tebar);
        $('#jumlah_bibit').val(data.jumlah_bibit);
        $('#pakan_perhari').val(data.pakan_perhari);
        $('#perkiraan_panen').val(data.perkiraan_panen);
        $('#status').val(data.status);
        $('#keterangan').val(data.keterangan);

        modal.removeClass('hidden');
    });

        $('#closeModal').on('click', () => modal.addClass('hidden'));

        // === SweetAlert Delete ===
        $('.deleteBtn').on('click', function() {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data ini akan dihapus permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/user/budidaya/' + id,
                type: 'DELETE', // gunakan DELETE langsung
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success')
                        .then(() => location.reload());
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                }
            });
        }
    });
});

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
    </script>
</body>
</html>
