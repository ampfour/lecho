@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Dashboard</h1>

  <div class="row">
    <div class="col-md-6">
      <tickets></tickets>
    </div>

    <div class="col-md-6">
      <div class="pmd-card pmd-card-default pmd-z-depth">
        <div class="pmd-card-title">
          <h2 class="pmd-card-title-text">Dashboard</h2>
          <span class="pmd-card-subtitle-text">Welcome</span>
        </div>

        <div class="pmd-card-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          You are logged in!
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
