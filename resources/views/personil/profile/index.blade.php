@extends('layouts.stisla')

@section('title', $title)

@section('content')
@include('components.breadcrumbs', [
    'title' => $title,
    'breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['label' => 'Profile']
    ]
])

<div class="section-body">
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <img alt="image" 
                        src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assets/img/avatar/avatar-1.png') }}" 
                        class="rounded-circle profile-widget-picture" style="width: 120px; height: 120px; object-fit: cover;">

                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Posts</div>
                            <div class="profile-widget-item-value">187</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Followers</div>
                            <div class="profile-widget-item-value">6,8K</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Following</div>
                            <div class="profile-widget-item-value">2,1K</div>
                        </div>
                    </div>
                </div>

                <div class="profile-widget-description">
                    <div class="profile-widget-name">
                        {{ $user->name }}
                        <div class="d-inline font-weight-normal" style="color: #3490dc;">
                            <div class="slash"></div> {{ $user->roles->pluck('name')->first() ?? 'User' }}
                        </div>
                    </div>

                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                        <li class="list-group-item"><strong>NIK:</strong> {{ $user->nik ?? '-' }}</li>
                        <li class="list-group-item"><strong>No. HP:</strong> {{ $user->no_hp ?? '-' }}</li>
                        <li class="list-group-item"><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</li>
                    </ul>
                </div>

                <div class="text-center mb-4">
                    <a href="{{ route('admin.personil.profil.index', ['edit' => 'true']) }}" class="btn btn-primary mt-2">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>

        {{-- Form Edit Profil --}}
        @if(request('edit') === 'true')
        <div class="col-12 col-md-6 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profil</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.personil.profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Foto --}}
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                            @if($user->foto)
                                <small class="form-text text-muted">Foto sekarang: <a href="{{ asset('storage/'.$user->foto) }}" target="_blank">Lihat</a></small>
                            @endif
                        </div>

                        {{-- Nama --}}
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}">
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}">
                        </div>

                        {{-- No HP --}}
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                        </div>

                        {{-- Alamat --}}
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>

                        <div class="form-group text-right">
                            <a href="{{ route('admin.personil.profil.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
// Tambahkan JS jika diperlukan
</script>
@endpush
