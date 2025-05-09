@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>Dashboard</h1>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số bài viết</h5>
                        <p class="card-text display-4">{{ \App\Models\Post::count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 