@extends('Admin.layouts.app')

@section('title', 'Users Page')

@section('contents')
    <div class="card p-3 shadow-lg">
        <div class="m-3 d-flex justify-content-between align-items-center">
            <h3>Welcome to the Users Page</h3>
            <button class="btn btn-primary">+ Add User</button>
        </div>

        <div class="card p-2 m-3 shadow-lg">
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>John Doe</td>
                        <td>john.doe@example.com</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection