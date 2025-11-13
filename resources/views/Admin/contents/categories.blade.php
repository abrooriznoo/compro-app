@extends('Admin.layouts.app')

@section('title', 'Categories Page')

@section('contents')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.home')}}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Master Content</a>
            </li>
            <li class="breadcrumb-item active">Categories Management</li>
        </ol>
    </nav>
    <div class="card p-2 shadow-lg">
        <div class="m-3 d-flex justify-content-between align-items-center">
            <h3>Welcome to the Categories Page</h3>
            <button class="btn btn-primary shadow-lg" data-bs-toggle="modal" data-bs-target="#modalAddCategory">+ Add
                Category</button>
        </div>

        <div class="card p-2 m-3 shadow-lg">
            <div class="table-responsive"> <!-- Pembungkus responsif -->
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categories->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No categories available.
                                </td>
                            </tr>
                        @else
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}.</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ Str::limit($category->description, 100) }}</td> {{-- opsional: batasi konten panjang --}}
                                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-light shadow-lg" data-bs-toggle="modal"
                                                data-bs-target="#modalCategoryEdit{{ $category->id }}">
                                                <i class="bx bx-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary shadow-lg" data-bs-toggle="modal"
                                                data-bs-target="#modalCategoryDelete{{ $category->id }}">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        @foreach ($categories as $category)
            <!-- Modal Edit -->
            <div class="modal fade" id="modalCategoryEdit{{ $category->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Modal Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameWithTitle" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="descriptionWithTitle" class="form-label">Description</label>
                                        <textarea name="description"
                                            class="form-control summernote">{{ $category->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Delete -->
            <div class="modal fade" id="modalCategoryDelete{{ $category->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Modal Delete Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete category "{{ $category->name }}"?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal Add -->
        <div class="modal fade" id="modalAddCategory" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Modal Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="descriptionWithTitle" class="form-label">Description</label>
                                    <textarea name="description"
                                        class="form-control @error('description') is-invalid @enderror summernote"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection