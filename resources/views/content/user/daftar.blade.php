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
                <div class="card mb-4">
                    <div class="card-body">
                        @if ($data->isEmpty())
                        <div class="text-center h2">Data masih kosong<br><a href="<?=route('user.tambah')?>"
                                class="btn btn-success" role="button">Tambah User</a></div>
                        @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No.</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                    @if(auth()->user()->id != $item->id)
                                        bisa dihapus
                                    @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @endif
                    </div> <!-- /.card-body -->

                    @if (!$data->isEmpty())
                    <!-- Pagination Links -->
                    <nav class="m-4">
                        <ul class="pagination pagination-sm m-0 float-end">
                            {{-- Previous Page Link --}}
                            @if ($data->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">«</span></li>
                            @else
                            <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}"
                                    rel="prev">«</a></li>
                            @endif

                            {{-- Pagination Links --}}
                            @for ($page = 1; $page <= $data->lastPage(); $page++)
                                @if ($page == $data->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{ $data->url($page) }}">{{ $page
                                        }}</a></li>
                                @endif
                                @endfor

                                {{-- Next Page Link --}}
                                @if ($data->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $data->nextPageUrl() }}"
                                        rel="next">»</a></li>
                                @else
                                <li class="page-item disabled"><span class="page-link">»</span></li>
                                @endif
                        </ul>
                    </nav>
                    @endif
                </div> <!-- /.card -->
            </div> <!-- /.col -->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>