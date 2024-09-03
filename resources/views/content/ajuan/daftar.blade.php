

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
                                <tr class="align-middle">
                                    <td>1.</td>
                                    <td>Ini nama</td>
                                    <td>Ini Deskripsi</td>
                                    <td>Ini Jumlah</td>
                                    <td>Ini Detail</td>
                                    <td>Ini Sifat</td>
                                    <td>Ini Tanggal Aju</td>
                                </tr>
                                @foreach($ajuans as $ajuan)
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
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            <li class="page-item"> <a class="page-link" href="#">«</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                            <li class="page-item"> <a class="page-link" href="#">»</a> </li>
                        </ul>
                    </div>
                </div> <!-- /.card -->
            </div> <!-- /.col -->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>