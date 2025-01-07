@extends('layout')

@section('content')
<body class="bg-light">
    <div class="container">
        <h1 class="text-center mb-4">Customers</h1>
        <div id="showproduct" class="row g-4">
        <div class="card">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <div class="card-header">{{ __('Table Customers') }}</div>

                <div class="card-body">
<!-- 
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-secondary">
                        Tambah User
                    </a>
                    <a href="{{ route('user-export') }}" class="btn btn-sm btn-primary">
                        Export User to Excel
                    </a>
-->
                    <table class="table table-striped" id="users">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>

                            @foreach($customers as $row)
                            <?php $no++ ?>
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->contact}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection