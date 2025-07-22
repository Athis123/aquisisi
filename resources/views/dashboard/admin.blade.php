@extends('layouts.stisla')

@section('title', 'Dashboard Admin')

@section('content')
  <div class="section-header">
    <h1>Dashboard Admin</h1>
  </div>

  <div class="section-body">
    <p>Selamat datang, {{ Auth::user()->name }}</p>

    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-stats">
            <div class="card-stats-title">
              Order Statistics
              <div class="dropdown d-inline">
                ...
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
