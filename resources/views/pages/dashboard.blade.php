@extends('layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard')
@section('header_subtitle', 'AdminLTE ready')

@section('content')
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <div class="text-muted">Users</div>
          <div style="font-size:28px; font-weight:800;">12,480</div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <div class="text-muted">Tickets</div>
          <div style="font-size:28px; font-weight:800;">38</div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <div class="text-muted">Uptime</div>
          <div style="font-size:28px; font-weight:800;">99.95%</div>
        </div>
      </div>
    </div>
  </div>
@endsection
