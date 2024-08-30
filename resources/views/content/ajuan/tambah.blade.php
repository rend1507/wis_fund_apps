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
                <div class="card card-success card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Input Group</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3"> <input type="text" class="form-control"
                                placeholder="Recipient's username" aria-label="Recipient's username"
                                aria-describedby="basic-addon2"> <span class="input-group-text"
                                id="basic-addon2">@example.com</span> </div>
                        <div class="mb-3"> <label for="basic-url" class="form-label">Your vanity URL</label>
                            <div class="input-group"> <span class="input-group-text"
                                    id="basic-addon3">https://example.com/users/</span>
                                <input type="text" class="form-control" id="basic-url"
                                    aria-describedby="basic-addon3 basic-addon4">
                            </div>
                            <div class="form-text" id="basic-addon4">
                                Example help text goes outside the input group.
                            </div>
                        </div>
                        <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text"
                                class="form-control" aria-label="Amount (to the nearest dollar)"> <span
                                class="input-group-text">.00</span> </div>
                        <div class="input-group mb-3"> <input type="text" class="form-control" placeholder="Username"
                                aria-label="Username"> <span class="input-group-text">@</span> <input type="text"
                                class="form-control" placeholder="Server" aria-label="Server"> </div>
                        <div class="input-group"> <span class="input-group-text">With textarea</span> <textarea
                                class="form-control" aria-label="With textarea"></textarea> </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer"> <button type="submit" class="btn btn-success float-end">Submit</button> </div>
                    <!--end::Footer-->
                </div>
                <!--end::Input Group-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>