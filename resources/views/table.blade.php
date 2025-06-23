@extends('layout.template')

@section('content')
    <div class="container-fluid mt-4 mb-4">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="welcome-section mb-4">
                    <div class="welcome-content">
                        <h2 class="welcome-title">📊 Data Management</h2>
                        <p class="welcome-subtitle">Kelola data geografis Anda dengan mudah dan efisien</p>
                    </div>
                </div>

                <!-- Image Preview Modal -->
                <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imagePreviewTitle">Image Preview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="modalPreviewImage" src="" class="img-fluid" alt="Preview Image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a id="downloadImageBtn" href="#" class="btn btn-primary" download>
                                    <i class="fa-solid fa-download me-1"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Points Section -->
                <div class="data-card mb-4">
                    <div class="card-header-custom">
                        <div class="header-content">
                            <div class="header-icon">📍</div>
                            <div>
                                <h4 class="header-title">Data Points</h4>
                                <p class="header-subtitle">Informasi titik-titik lokasi wisata</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body-custom">
                        <div class="table-responsive">
                            <table class="table custom-table" id="pointstable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Images</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($points as $p)
                                        <tr>
                                            <td><span class="badge-custom">{{ $p->id }}</span></td>
                                            <td class="fw-bold text-primary">{{ $p->name }}</td>
                                            <td>{{ $p->description }}</td>
                                            <td>
                                                <div class="image-container">
                                                    <img src="{{ asset('storage/images/' . $p->images) }}"
                                                         class="table-image clickable-image"
                                                         title="{{ $p->images }}"
                                                         data-src="{{ asset('storage/images/' . $p->images) }}"
                                                         data-title="{{ $p->name }}"
                                                         alt="{{ $p->name }} image">
                                                    <div class="image-overlay">
                                                        <i class="fa-solid fa-search-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted">{{ $p->created_at }}</td>
                                            <td class="text-muted">{{ $p->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Data Polylines Section -->
                <div class="data-card mb-4">
                    <div class="card-header-custom">
                        <div class="header-content">
                            <div class="header-icon">🛤️</div>
                            <div>
                                <h4 class="header-title">Data Polylines</h4>
                                <p class="header-subtitle">Informasi jalur dan rute perjalanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body-custom">
                        <div class="table-responsive">
                            <table class="table custom-table" id="polylinestable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Images</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($polylines as $p)
                                        <tr>
                                            <td><span class="badge-custom">{{ $p->id }}</span></td>
                                            <td class="fw-bold text-primary">{{ $p->name }}</td>
                                            <td>{{ $p->description }}</td>
                                            <td>
                                                <div class="image-container">
                                                    <img src="{{ asset('storage/images/' . $p->images) }}"
                                                         class="table-image clickable-image"
                                                         title="{{ $p->images }}"
                                                         data-src="{{ asset('storage/images/' . $p->images) }}"
                                                         data-title="{{ $p->name }}"
                                                         alt="{{ $p->name }} image">
                                                    <div class="image-overlay">
                                                        <i class="fa-solid fa-search-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted">{{ $p->created_at }}</td>
                                            <td class="text-muted">{{ $p->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Data Polygons Section -->
                <div class="data-card mb-4">
                    <div class="card-header-custom">
                        <div class="header-content">
                            <div class="header-icon">🏞️</div>
                            <div>
                                <h4 class="header-title">Data Polygons</h4>
                                <p class="header-subtitle">Informasi area dan wilayah geografis</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body-custom">
                        <div class="table-responsive">
                            <table class="table custom-table" id="polygontable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Images</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($polygons as $p)
                                        <tr>
                                            <td><span class="badge-custom">{{ $p->id }}</span></td>
                                            <td class="fw-bold text-primary">{{ $p->name }}</td>
                                            <td>{{ $p->description }}</td>
                                            <td>
                                                <div class="image-container">
                                                    <img src="{{ asset('storage/images/' . $p->images) }}"
                                                         class="table-image clickable-image"
                                                         title="{{ $p->images }}"
                                                         data-src="{{ asset('storage/images/' . $p->images) }}"
                                                         data-title="{{ $p->name }}"
                                                         alt="{{ $p->name }} image">
                                                    <div class="image-overlay">
                                                        <i class="fa-solid fa-search-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted">{{ $p->created_at }}</td>
                                            <td class="text-muted">{{ $p->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Welcome Section */
    .welcome-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        text-align: center;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
        margin-bottom: 30px;
    }

    .welcome-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .welcome-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }

    /* Data Cards */
    .data-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .data-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 25px 30px;
        border: none;
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .header-icon {
        font-size: 2.5rem;
        background: rgba(255,255,255,0.2);
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .header-title {
        color: white;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .header-subtitle {
        color: rgba(255,255,255,0.8);
        margin-bottom: 0;
        font-size: 0.9rem;
    }

    .card-body-custom {
        padding: 30px;
    }

    /* Table Styling */
    .custom-table {
        border: none;
        margin-bottom: 0;
    }

    .custom-table thead th {
        background: linear-gradient(135deg, #f8f9ff 0%, #e6eaff 100%);
        border: none;
        padding: 15px;
        font-weight: 600;
        color: #4a5568;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .custom-table tbody tr {
        border-bottom: 1px solid #e2e8f0;
        transition: background-color 0.3s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8faff;
    }

    .custom-table tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        border: none;
    }

    /* Badge Styling */
    .badge-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 15px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    /* Image Styling */
    .image-container {
        position: relative;
        display: flex;
        justify-content: center;
        cursor: pointer;
    }

    .table-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .image-overlay i {
        color: white;
        font-size: 1.5rem;
    }

    .image-container:hover .table-image {
        transform: scale(1.05);
    }

    .image-container:hover .image-overlay {
        opacity: 1;
    }

    /* Modal Styling */
    #imagePreviewModal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    #imagePreviewModal .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    #imagePreviewModal .modal-body {
        padding: 20px;
    }

    #modalPreviewImage {
        max-height: 70vh;
        width: auto;
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* DataTables Customization */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 20px;
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 15px;
        margin-left: 10px;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #667eea;
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px;
        margin: 0 2px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        border: none !important;
        color: white !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .welcome-section {
            padding: 30px 20px;
        }

        .welcome-title {
            font-size: 2rem;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .header-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }

        .card-body-custom {
            padding: 20px;
        }

        .table-image {
            width: 60px;
            height: 60px;
        }
    }

    /* Custom Scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    }
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTables with custom options
        let tablepoints = new DataTable('#pointstable', {
            responsive: true,
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                emptyTable: "Tidak ada data yang tersedia"
            }
        });

        let tablepolylines = new DataTable('#polylinestable', {
            responsive: true,
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                emptyTable: "Tidak ada data yang tersedia"
            }
        });

        let tablepolygons = new DataTable('#polygontable', {
            responsive: true,
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                emptyTable: "Tidak ada data yang tersedia"
            }
        });

        // Initialize image preview modal
        const imagePreviewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));

        // Handle click on images
        $('.clickable-image').on('click', function() {
            const imgSrc = $(this).data('src');
            const imgTitle = $(this).data('title');

            $('#modalPreviewImage').attr('src', imgSrc);
            $('#imagePreviewTitle').text(imgTitle);
            $('#downloadImageBtn').attr('href', imgSrc);

            imagePreviewModal.show();
        });

        // Make entire image container clickable
        $('.image-container').on('click', function() {
            $(this).find('.clickable-image').trigger('click');
        });
    });
</script>
@endsection
