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
                    <li class="breadcrumb-item"><a href="#">User</a></li>
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
                <div class="card card-outline mb-4 <?=session('edit_id') ? 'card-warning' : 'card-success'?>">
                    <form action="<?=route('user.form.action')?>">
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nama-pengajuan" class="form-label">Nama User</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama User"
                                    aria-label="Nama User" id="name" name="name"
                                    value="{{ isset($data) ? $data->name :"" }}">
                            </div>
                            @if(isset($data))
                            E-Mail Lama:
                            {{ isset($data) ? $data->email :"" }}<br>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail Baru:</label>
                                <input type="email" class="form-control" placeholder="Masukkan e-mail baru"
                                    aria-label="Email" id="email" name="email">
                            </div>
                            <div class="mb-3">

                                <label for="email-confirm" class="form-label">Konfirmasi E-mail Baru:</label>
                                <input type="email" class="form-control" placeholder="Masukkan konfirmasi e-mail baru"
                                    aria-label="Email Confirm" id="email-confirm" name="email-confirm">
                            </div>
                            @else<div class="mb-3">
                                <label for="email" class="form-label">Masukkan E-Mail:</label>
                                <input type="email" class="form-control" placeholder="Masukkan E-mail"
                                    aria-label="Email" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Masukkan Password:</label>
                                <input type="password" class="form-control" placeholder=""
                                    aria-label="Password" id="password" name="password">
                            </div>
                            @endif
                        </div>

                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            @if(session('edit_id'))
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