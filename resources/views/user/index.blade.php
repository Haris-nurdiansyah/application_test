@extends('app', ['title' => 'User'])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                        {{ $message }}
                        </div>
                    @endif
                    <form action="{{ route('users.index') }}">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="name" placeholder="Nama">
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="birth_date">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="position_applied" placeholder="Posisi yang dilamar">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-dark" style="width: 100%">Search</button>
                            </div>
                        </div>
                    </form>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Posisi Yang Dilamar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $user->name ?? '-' }}</td>
                                    <td>{{ $user->birth_date ?? '-' }}</td>
                                    <td>{{ $user->position_applied ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('users.edit_biodata', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="javascript:void(0)" data-id="{{ $user->id }}" class="btn btn-delete btn-danger btn-sm">
                                           Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" id="form-delete" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-square btn-outline-light" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-square btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $("body").on("click", ".btn-delete", function() {
            let id = $(this).data("id");
            $("#form-delete").attr('action', '{{ url("/users/delete/") }}' + "/" + id);
            $("#deleteModal").modal('show');
        })
    </script>
@endpush