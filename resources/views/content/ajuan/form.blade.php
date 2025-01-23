<?php
$isEdit = Route::is('ajuan.edit');
?>


<!--begin::App Content Header-->
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
                    <li class="breadcrumb-item"><a href="<?=route('home')?>">Dashboard</a></li>
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
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row g-4">
            <!--begin::Col-->
            <div class="col">
                <!--begin::Input Group-->
                <div class="card card-outline mb-4 <?=$isEdit ? 'card-warning' : 'card-success'?>">
                    <form action="<?=route('ajuan.form.action')?>" method="POST">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama-pengajuan" class="form-label">Nama Pengajuan</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama pengajuan" aria-label="Nama Pengajuan"
                                id="nama-pengajuan" name="nama_pengajuan" value="{{ isset($data) ? $data->nama_pengajuan :"" }}" >
                        </div>
                        
                        <div class="mb-3">
                            <label for="deksripsi-pengajuan" class="form-label">Deskripsi Pengajuan</label>
                            <textarea class="form-control" aria-label="With textarea" id="deskripsi-pengajuan" name="deskripsi_pengajuan">{{ isset($data) ? $data->deskripsi_pengajuan :"" }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah-anggaran-pengajuan" class="form-label">Jumlah Anggaran Pengajuan</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="jumlah-anggaran-pengajuan-1">Rp</span>
                                <input type="number" class="form-control" placeholder="Contoh : 1000" aria-label="Jumlah Anggaran Pengajuan"
                                    aria-describedby="jumlah-anggaran-pengajuan" name="jumlah_anggaran_pengajuan" id="jumlah-anggaran-pengajuan"
                                    value="{{ isset($data) ? $data->jumlah_anggaran_pengajuan :"" }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="detail-anggaran-pengajuan" class="form-label">Detail Anggaran</label>
                            <textarea class="form-control" aria-label="With textarea" id="detail-pengajuan"
                                name="detail_anggaran_pengajuan">{{ isset($data) ? $data->detail_anggaran_pengajuan :"" }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="sifat-pengajuan" class="form-label">Sifat Anggaran</label>
                            <br>
                            <select name="sifat_pengajuan" class="form-control" id="sifat-pengajuan">
                                <option value="0" {{ isset($data) ? $data->sifat_pengajuan=="0" ? "selected" : "" : "" }}>Biasa</option>
                                <option value="1" {{ isset($data) ? $data->sifat_pengajuan=="1" ? "selected" : "" : "" }}>Mendesak</option>
                            </select>
                        </div>
                        
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                        @if($isEdit)
                        <input type="disabled" class="hidden d-none invisible" readonly value="<?=$data->id_pengajuan?>" name="id_pengajuan">
                        <button type="submit" class="btn btn-warning float-end">Edit</button>
                        @else
                        <button type="submit" class="btn btn-success float-end">Submit</button>
                        @endif
                    </div>
                    <!--end::Footer-->
                    </form>
                </div>
                <!--end::Input Group-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>