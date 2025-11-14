@extends('index')

@section('title', 'Blogs - My Compro App')

@section('contents')
    <div class="container p-3 mt-5">
        <div class="d-flex flex-column align-items-center">
            <h3>Blogs Page</h3>

            <div class="d-flex gap-3 mt-4">
                <input type="text" class="form-control rounded-pill" style="width: 500px;" placeholder="Search Blogs..." />
                <button class="btn btn-primary rounded-pill">Search</button>
            </div>
        </div>

        <div class="mb-5">
            <div class="row mt-3 g-4">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card shadow-lg blog-card h-100">
                            {{-- Foto Blog --}}
                            @if ($blog->photos)
                                @foreach(json_decode($blog->photos, true) as $photo)
                                    <img src="{{ asset('storage/blogs_photos/' . trim($photo)) }}" class="card-img-top" alt="Blog Photo"
                                        style="height: 200px; object-fit: cover;">
                                @endforeach
                            @else
                                {{-- Jika tidak ada foto, tampilkan placeholder --}}
                                <img src="https://via.placeholder.com/400x200?text=No+Image" class="card-img-top" alt="No Image"
                                    style="height: 200px; object-fit: cover;">
                            @endif

                            <div class="card-body d-flex flex-column">

                                {{-- Judul --}}
                                <h5 class="card-title">
                                    {{ Str::words(strip_tags($blog->title), 10, '...') }}
                                </h5>

                                {{-- Penulis & Tanggal --}}
                                <small class="text-muted d-block mb-2">
                                    By <strong>{{ $blog->writer ?? 'Unknown' }}</strong> •
                                    {{ $blog->created_at->format('d M Y') }}
                                </small>

                                {{-- Konten --}}
                                <p class="card-text flex-grow-1 mt-2">
                                    {!! Str::words(strip_tags($blog->content), 50, '...') !!}
                                </p>

                                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                                    data-bs-target="#modalBlogRead{{ $blog->id }}">Read More</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalBlogRead{{ $blog->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content rounded-4 shadow">

                                <!-- Modal Header -->
                                <div class="modal-header bg-primary text-white rounded-top-4">
                                    <!-- <h5 class="modal-title">{{ $blog->title }}</h5> -->
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row g-4">

                                            <!-- Photo Gallery -->
                                            <div class="col-12 mb-3">
                                                @if($blog->photos)
                                                    <div class="row g-2">
                                                        @foreach(json_decode($blog->photos, true) as $photo)
                                                            <div class="col-md-6">
                                                                <img src="{{ asset('storage/blogs_photos/' . trim($photo)) }}"
                                                                    class="img-fluid rounded shadow-sm w-100" alt="{{ $blog->title }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="text-center p-5 bg-light rounded">
                                                        <i class="bi bi-image" style="font-size: 3rem; opacity: 0.5;"></i>
                                                        <p class="text-muted mt-2">No Image Available</p>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Blog Content -->
                                            <div class="col-12">
                                                <!-- Category Badge -->
                                                <span class="badge bg-secondary mb-2">{{ $blog->category->name }}</span>

                                                <!-- Content -->
                                                <!-- <p class="text-muted mb-1"><strong>ID:</strong> {{ $blog->id }}</p> -->
                                                <h4 class="fw-bold">{{ $blog->title }}</h4>
                                                <div class="card-body m-3 shadow-lg">{!! $blog->content !!}</div>

                                                <!-- Writer & Created At -->
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <div class="card border-0 bg-light">
                                                            <div class="card-body d-flex align-items-center">
                                                                <i class="bi bi-person-circle me-3 fs-3 text-primary"></i>
                                                                <div>
                                                                    <small class="text-muted">Writer</small>
                                                                    <div class="fw-bold">{{ $blog->writer ?? 'Anonymous' }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card border-0 bg-light">
                                                            <div class="card-body d-flex align-items-center">
                                                                <i class="bi bi-calendar-event me-3 fs-3 text-primary"></i>
                                                                <div>
                                                                    <small class="text-muted">Published</small>
                                                                    <div class="fw-bold">
                                                                        {{ $blog->created_at->format('d M Y, H:i') }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> <!-- End Blog Content -->

                                        </div> <!-- End Row -->
                                    </div> <!-- End Container -->
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection