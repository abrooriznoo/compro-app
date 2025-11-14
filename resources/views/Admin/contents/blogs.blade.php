@extends('Admin.layouts.app')

@section('title', 'Blogs Page')

@section('contents')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.home')}}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Master Content</a>
            </li>
            <li class="breadcrumb-item active">Blogs Management</li>
        </ol>
    </nav>
    <div class="card p-2 shadow-lg">
        <div class="m-3 d-flex justify-content-between align-items-center">
            <h3>Welcome to the Blogs Page</h3>
            <button class="btn btn-primary shadow-lg" data-bs-toggle="modal" data-bs-target="#modalAddBlog">+ Add
                Blog</button>
        </div>

        <div class="card p-2 m-3 shadow-lg">
            <div class="table-responsive"> <!-- Pembungkus responsif -->
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Writer</th>
                            <th>Content</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($blogs->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No blogs available.
                                </td>
                            </tr>
                        @else
                            @foreach ($blogs as $index => $blog)
                                <tr>
                                    <td>{{ $index + 1 }}.</td>
                                    <td>
                                        @if($blog->photos)
                                            @foreach(json_decode($blog->photos, true) as $photo)
                                                <img src="{{ asset('storage/blogs_photos/' . trim($photo)) }}" alt="Blog Photo" width="100">
                                            @endforeach
                                        @else
                                            <span class="text-muted">No Photos</span>
                                        @endif
                                    </td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->writer }}</td>
                                    <td>{{ Str::limit($blog->content, 50) }}</td> {{-- opsional: batasi konten panjang --}}
                                    <td>{{ $blog->category->name ?? '-' }}</td>
                                    <td>
                                        @if($blog->status == 1)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-light shadow-lg" data-bs-toggle="modal"
                                                data-bs-target="#modalBlogEdit{{ $blog->id }}">
                                                <i class="bx bx-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary shadow-lg" data-bs-toggle="modal"
                                                data-bs-target="#modalBlogDelete{{ $blog->id }}">
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

        @foreach ($blogs as $blog)
            <!-- Modal Edit -->
            <div class="modal fade" id="modalBlogEdit{{ $blog->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Modal Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <!-- Preview Photos -->
                                <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Current Photos</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @if($blog->photos)
                                                @foreach(json_decode($blog->photos, true) as $photo)
                                                    <img src="{{ asset('storage/blogs_photos/' . trim($photo)) }}" alt="Blog Photo"
                                                        width="100">
                                                @endforeach
                                            @else
                                                <span class="text-muted">No Photos</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="photosWithTitle" class="form-label">Photos</label>
                                        <input type="file" name="photos[]" multiple
                                            class="form-control @error('photos') is-invalid @enderror">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="titleWithTitle" class="form-label">Title</label>
                                        <input type="text" name="title" value="{{ $blog->title }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="contentWithTitle" class="form-label">Content</label>
                                        <textarea name="content" class="summernote"
                                            class="form-control">{{ $blog->content }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="categoryWithTitle" class="form-label">Category</label>
                                        <select name="category_id" id="categoryWithTitle" class="form-control">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Status</label>

                                        {{-- Fallback jika switch OFF, maka status = 0 --}}
                                        <input type="hidden" name="status" value="0">

                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input status-switch" name="status"
                                                value="1" {{ isset($blog) && $blog->status == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                {{ isset($blog) && $blog->status == 1 ? 'Published' : 'Draft' }}
                                            </label>
                                        </div>
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
            <div class="modal fade" id="modalBlogDelete{{ $blog->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Modal Delete Blog</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete blog "{{ $blog->title }}"?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST">
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
        <div class="modal fade" id="modalAddBlog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Modal Add Blog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="photosWithTitle" class="form-label">Photos</label>
                                    <input type="file" name="photos[]" multiple
                                        class="form-control @error('photos') is-invalid @enderror">
                                    @error('photos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="titleWithTitle" class="form-label">Title</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="contentWithTitle" class="form-label">Content</label>
                                    <textarea name="content" class="summernote" class="form-control"></textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="categoryWithTitle" class="form-label">Category</label>
                                    <select name="category_id" id="categoryWithTitle" class="form-control">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Status</label>

                                    {{-- Fallback jika switch OFF, maka status = 0 --}}
                                    <input type="hidden" name="status" value="0">

                                    <div class="form-check form-switch">
                                        <!-- Default checked = true -->
                                        <input type="checkbox" class="form-check-input status-switch" name="status"
                                            value="1" checked>
                                        <label class="form-check-label">Published</label>
                                    </div>
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