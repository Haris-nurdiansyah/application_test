@extends('app', ['title' => 'User'])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (auth()->user()->id == $user->id)
                <div class="card mt-4">
                    <div class="card-header text-center">
                        <h5>Profile</h5>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success1'))
                            <div class="alert alert-success">
                            {{ $message }}
                            </div>
                        @endif
                        <form action="{{ route('users.update_profile') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Nama Akun</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="{{ auth()->user()->email }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            @endif
            @if (!auth()->user()->is_admin || auth()->user()->id != $user->id)
                <div class="card mt-2">
                    <div class="card-header text-center">
                        <h5>Data Pribadi Pelamar</h5>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success2'))
                            <div class="alert alert-success">
                            {{ $message }}
                            </div>
                        @endif
                        <form action="{{ route('users.update_biodata', ['id' => $user->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="position_applied" class="form-label">Posisi Yang Dilamar</label>
                                <input type="text" class="form-control" id="position_applied" name="position_applied" value="{{ $biodata->position_applied ?? old('position_applied') }}" placeholder="Posisi yang dilamar" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $biodata->name ?? old('name') }}" placeholder="Nama" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_ktp" class="form-label">NO. KTP</label>
                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ $biodata->no_ktp ?? old('name') }}" placeholder="NO. KTP" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="birth_date" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control mt-0" id="birth_date" name="birth_date" value="{{ $biodata->birth_date ?? old('birth_date') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="golongan_darah" class="form-label">Golongan Darah</label>
                                    <input type="text" class="form-control mt-0" id="golongan_darah" name="golongan_darah" value="{{ $biodata->golongan_darah ?? old('golongan_darah') }}" placeholder="Golongan darah" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Jenis Kelaminn</option>
                                        <option value="L" @if (isset($biodata->gender))
                                            @if ($biodata->gender == 'L')
                                                selected
                                            @endif 
                                        @endif>Laki - Laki</option>
                                        <option value="P" @if (isset($biodata->gender))
                                            @if ($biodata->gender == 'P')
                                                selected
                                            @endif 
                                        @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3 ">
                                    <label for="religion">Agama</label>
                                    <select class="form-control" id="religion" name="religion">
                                        <option value="">Agaman</option>
                                        <option value="islam" @if (isset($biodata->religion))
                                            @if ($biodata->religion == 'islam')
                                                selected
                                            @endif 
                                        @endif>Islam</option>
                                        <option value="kristen" @if (isset($biodata->religion))
                                            @if ($biodata->religion == 'kristen')
                                                selected
                                            @endif 
                                        @endif>Kristen</option>
                                        <option value="hindu" @if (isset($biodata->religion))
                                            @if ($biodata->religion == 'hindu')
                                                selected
                                            @endif 
                                        @endif>Budha</option>
                                        <option value="budha" @if (isset($biodata->religion))
                                            @if ($biodata->religion == 'budha')
                                                selected
                                            @endif 
                                        @endif>Budha</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input placeholder="Email address" type="email" class="form-control mt-0" id="email" name="email" value="{{ $biodata->email ?? old('email') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="no_telp" class="form-label">Nomor Handphone</label>
                                        <input placeholder="No handphone" type="number" class="form-control mt-0" id="no_telp" name="no_telp" value="{{ $biodata->no_telp ?? old('no_telp') }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" value="{{ $biodata->status ?? old('status') }}" placeholder="Status" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="related_person" class="form-label">Orang Terdekat Yg dapat Dihubungi</label>
                                        <input type="text" class="form-control" id="related_person" name="related_person" value="{{ $biodata->related_person ?? old('related_person') }}" placeholder="Orang terdekat yang dapat dihubungi" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="ktp_address">Alamat KTP</label>
                                    <textarea class="form-control" id="ktp_address" rows="3" placeholder="Alamat KTP" name="ktp_address">
                                        {{ $biodata->ktp_address ?? old('ktp_address') }}
                                    </textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="address">Alamat Tinggal</label>
                                    <textarea class="form-control" id="address" rows="3" placeholder="Alamat Tinggal" name="address">
                                        {{ $biodata->address ?? old('address') }}
                                    </textarea>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label for="">Pendidikan Terakhir</label>
                                        <button type="button" class="btn btn-sm btn-primary" id="add-education">Tambah</button>
                                    </div>
                                    <table class="table table-bordered" id="table-education">
                                        <thead>
                                            <tr>
                                                <th>Jenjang Pendidikan</th>
                                                <th>Nama Intitusi</th>
                                                <th>Jurusan</th>
                                                <th>Tahun Lulus</th>
                                                <th>IPK</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($biodata) && count($biodata->last_educations) > 0)
                                                @foreach ($biodata->last_educations as $key => $education)
                                                    <tr id="education-{{ $key + 1 }}">
                                                        <td><input placeholder="Jenjang pendidikan" type="text" class="form-control" id="education_namme[]" name="education_namme[]" value="{{ $education->education_namme }}" required></td>
                                                        <td><input placeholder="Nama Institusi" type="text" class="form-control" id="institution[]" name="institution[]" value="{{ $education->institution }}" required></td>
                                                        <td><input placeholder="Jurusan" type="text" class="form-control" id="major[]" name="major[]" value="{{ $education->major }}" required></td>
                                                        <td><input type="date" class="form-control" id="graduation_date[]" name="graduation_date[]" value="{{ $education->graduation_date }}" required></td>
                                                        <td><input placeholder="IPK" type="number" class="form-control mt-0" id="ipk[]" name="ipk[]" value="{{ $education->ipk }}" required></td>
                                                        <td><button type="button" class="btn btn-sm btn-danger btn-delete-education" data-count="{{ $key + 1 }}">Delete</button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr id="education-1">
                                                    <td><input placeholder="Jenjang pendidikan" type="text" class="form-control" id="education_namme[]" name="education_namme[]"  required></td>
                                                    <td><input placeholder="Nama Institusi" type="text" class="form-control" id="major[]" name="institution[]" required></td>
                                                    <td><input placeholder="Jurusan" type="text" class="form-control" id="major[]" name="major[]" required></td>
                                                    <td><input type="date" class="form-control" id="graduation_date[]" name="graduation_date[]" required></td>
                                                    <td><input placeholder="IPK" type="number" class="form-control mt-0" id="ipk[]" name="ipk[]" required></td>
                                                    <td><button type="button" class="btn btn-sm btn-danger btn-delete-education" data-count="1">Delete</button></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label for="">Riwayat Pelatihan</label>
                                        <button type="button" class="btn btn-sm btn-primary" id="add-training">Tambah</button>
                                    </div>
                                    <table class="table table-bordered" id="table-training">
                                        <thead>
                                            <tr>
                                                <th>Nama Kursus</th>
                                                <th>Sertifikat</th>
                                                <th>Tahun</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($biodata) && count($biodata->training_histories) > 0)
                                                @foreach ($biodata->training_histories as $key2 => $training)
                                                    <tr id="training-{{ $key2 + 1 }}">
                                                        <td><input placeholder="Nama Kursus" type="text" class="form-control" id="training_name[]" name="training_name[]" value="{{ $training->name }}" required></td>
                                                        <td>
                                                            <select class="form-control" id="certificate" name="certificate[]"required >
                                                                <option value="">Sertifikat Ada / Tidak</option>
                                                                <option value="true" @if (isset($training->certificate))
                                                                    @if ($training->certificate == 1)
                                                                        selected
                                                                    @endif 
                                                                @endif>Ada</option>
                                                                <option value="false" @if (isset($training->certificate))
                                                                    @if ($training->certificate == 0)
                                                                        selected
                                                                    @endif 
                                                                @endif>Tidak</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="date" class="form-control" id="graduation_date_training[]" name="graduation_date_training[]" value="{{ $training->graduation_date }}" required></td>
                                                        <td><button type="button" class="btn btn-sm btn-danger btn-delete-training" data-count="{{ $key2 + 1 }}">Delete</button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr id="training-1">
                                                    <td><input placeholder="Nama Kursus" type="text" class="form-control" id="training_name[]" name="training_name[]" required></td>
                                                    <td>
                                                        <select class="form-control" id="certificate" name="certificate[]" required >
                                                            <option value="">Sertifikat Ada / Tidak</option>
                                                            <option value="true">Ada</option>
                                                            <option value="false">Tidak</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="date" class="form-control" id="graduation_date_training[]" name="graduation_date_training[]" required></td>
                                                    <td><button type="button" class="btn btn-sm btn-danger btn-delete-training" data-count="1">Delete</button></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label for="">Riwayat Pekerjaan</label>
                                        <button type="button" class="btn btn-sm btn-primary" id="add-work">Tambah</button>
                                    </div>
                                    <table class="table table-bordered" id="table-work">
                                        <thead>
                                            <tr>
                                                <th>Nama Perusahaan</th>
                                                <th>Posisi Terakhir</th>
                                                <th>Pendapatan Terakhir</th>
                                                <th>Tahun</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($biodata) && count($biodata->work_histories) > 0)
                                                @foreach ($biodata->work_histories as $key3 => $work)
                                                    <tr id="work-{{ $key3 + 1 }}">
                                                        <td><input placeholder="Nama Perusahaan" type="text" class="form-control" id="company_name[]" name="company_name[]" value="{{ $work->company_name }}" required></td>
                                                        <td><input placeholder="Posisi Terakahir" type="text" class="form-control" id="last_position[]" name="last_position[]" value="{{ $work->last_position }}" required></td>
                                                        <td><input placeholder="Last Salary" type="number" class="form-control" id="last_salary[]" name="last_salary[]" value="{{ $work->last_salary }}" required></td>
                                                        <td><input type="date" class="form-control" id="work_date[]" name="work_date[]" value="{{ $work->work_date }}" required></td>
                                                        <td><button type="button" class="btn btn-sm btn-danger btn-delete-work" data-count="{{ $key3 + 1 }}">Delete</button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr id="work-1">
                                                    <td><input placeholder="Nama Perusahaan" type="text" class="form-control" id="company_name[]" name="company_name[]" required></td>
                                                    <td><input placeholder="Posisi Terakahir" type="text" class="form-control" id="last_position[]" name="last_position[]" required></td>
                                                    <td><input placeholder="Last Salary" type="number" class="form-control" id="last_salary[]" name="last_salary[]"  required></td>
                                                    <td><input type="date" class="form-control" id="work_date[]" name="work_date[]" required></td>
                                                    <td><button type="button" class="btn btn-sm btn-danger btn-delete-work" data-count="1">Delete</button></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-3">
                                    <label for="gender">Bersedia Ditempatkan Diseluruh Kantor Perusahaan</label>
                                    <select class="form-control" id="job_placement_confirmation" name="job_placement_confirmation" required>
                                        <option value="">Pilih</option>
                                        <option value="true" @if (isset($biodata->job_placement_confirmation))
                                            @if ($biodata->job_placement_confirmation == true)
                                                selected
                                            @endif 
                                        @endif>Ya</option>
                                        <option value="false" @if (isset($biodata->job_placement_confirmation))
                                            @if ($biodata->job_placement_confirmation == false)
                                                selected
                                            @endif 
                                        @endif>Tidak</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="skills" class="form-label">Skills</label>
                                    <input placeholder="skills" type="text" class="form-control mt-0" id="skills" name="skills" value="{{ $biodata->skills ?? old('skills') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="salary_expecation" class="form-label">Penghasilan Yang Diharapkan</label>
                                    <input placeholder="Penghasilan yang diharapkan" type="number" class="form-control mt-0" id="salary_expecation" name="salary_expecation" value="{{ $biodata->salary_expecation ?? old('salary_expecation') }}" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('script')
    <script>
        let education = {{( $biodata) ? count($biodata->last_educations) ?? 1 : 1 }};
        let training = {{ ($biodata) ? count($biodata->training_histories) ?? 1 : 1 }};
        let work = {{ ($biodata) ? count($biodata->work_histories) ?? 1 : 1 }};

        $('#add-education').on('click', function () {
            education++;
            $('#table-education tbody').append(
                `<tr id="education-${education}">
                    <td><input placeholder="Jenjang pendidikan" type="text" class="form-control" id="education_namme[]" name="education_namme[]"  required></td>
                    <td><input placeholder="Nama Institusi" type="text" class="form-control" id="institution[]" name="institution[]" required></td>
                    <td><input placeholder="Jurusan" type="text" class="form-control" id="major[]" name="major[]" required></td>
                    <td><input type="date" class="form-control" id="graduation_date[]" name="graduation_date[]" required></td>
                    <td><input placeholder="IPK" type="number" class="form-control mt-0" id="ipk[]" name="ipk[]" required></td>
                    <td><button type="button" class="btn btn-sm btn-danger btn-delete-education" data-count="${education}">Delete</button></td>
                </tr>`
            )
        });

        $("body").on("click", ".btn-delete-education", function() {
            let count = $(this).data('count');
            $(`#education-${count}`).remove();
        });

        $('#add-training').on('click', function () {
            education++;
            $('#table-training tbody').append(
                `<tr id="training-${training}">
                    <td><input placeholder="Nama Kursus" type="text" class="form-control" id="training_name[]" name="training_name[]" required></td>
                    <td>
                        <select class="form-control" id="certificate" name="certificate[]"required >
                            <option value="">Sertifikat Ada / Tidak</option>
                            <option value="true" @if (isset($biodata->certificate))
                                @if ($biodata->certificate == true)
                                    selected
                                @endif 
                            @endif>Ada</option>
                            <option value="false" @if (isset($biodata->certificate))
                                @if ($biodata->certificate == false)
                                    selected
                                @endif 
                            @endif>Tidak</option>
                        </select>
                    </td>
                    <td><input type="date" class="form-control" id="graduation_date_training[]" name="graduation_date_training[]" required></td>
                    <td><button type="button" class="btn btn-sm btn-danger btn-delete-training" data-count="${training}">Delete</button></td>
                </tr>`
            )
        });

        $("body").on("click", ".btn-delete-training", function() {
            let count = $(this).data('count');
            $(`#training-${count}`).remove();
        });

        $('#add-work').on('click', function () {
            work++;
            $('#table-work tbody').append(
                `<tr id="work-${work}">
                    <td><input placeholder="Nama Perusahaan" type="text" class="form-control" id="company_name[]" name="company_name[]" required></td>
                    <td><input placeholder="Posisi Terakahir" type="text" class="form-control" id="last_position[]" name="last_position[]" required></td>
                    <td><input placeholder="Last Salary" type="number" class="form-control" id="last_salary[]" name="last_salary[]"  required></td>
                    <td><input type="date" class="form-control" id="work_date[]" name="work_date[]" required></td>
                    <td><button type="button" class="btn btn-sm btn-danger btn-delete-work" data-count="${work}">Delete</button></td>
                </tr>`
            )
        });

        $("body").on("click", ".btn-delete-work", function() {
            let count = $(this).data('count');
            console.log(count);
            $(`#work-${count}`).remove();
        });
    </script>
@endpush