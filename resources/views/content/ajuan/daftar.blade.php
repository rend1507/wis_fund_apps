

<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">@yield("title")</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="<?=route("home")?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Pengajuan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @yield("title")
                    </li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>

<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-12">
                @if (session("success"))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card mb-4"><div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">Nomor</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah (Rp)</th>
                                    <th>Detail</th>
                                    <th>Sifat</th>
                                    <th>Diajukan Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($data as $ajuan)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $ajuan->nama_pengajuan }}</td>
                                        <td>{{ $ajuan->deskripsi_pengajuan }}</td>
                                        <td>{{ $ajuan->jumlah_anggaran_pengajuan }}</td>
                                        <td>{{ $ajuan->detail_anggaran_pengajuan }}</td>
                                        <td class="text-center">
                                            <div class="badge w-100 bg-{{ $ajuan->sifat_pengajuan=="0" ? "primary": "danger"}}">
                                                {{ $ajuan->sifat_pengajuan=="0" ? "Biasa": "MENDESAK"}}
                                            </div>
                                        </td>
                                        <td>{{ $ajuan->created_at_pengajuan_formatted }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                    @if ($data->isEmpty())
                    <p>No data available.</p>
                    @endif
                    
                    <!-- Pagination Links -->
                    
                    <nav>
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($data->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                            @else
                            <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev">Previous</a></li>
                            @endif
                    
                            {{-- Pagination Links --}}
                            @for ($page = 1; $page <= $data->lastPage(); $page++)
                                @if ($page == $data->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{ $data->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endfor
                    
                            {{-- Next Page Link --}}
                            @if ($data->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next">Next</a></li>
                            @else
                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                            @endif
                        </ul>
                    </nav>
                </div> <!-- /.card -->
            </div> <!-- /.col -->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>