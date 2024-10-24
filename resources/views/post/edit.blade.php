@include('head')

<!-- Sidebar Start -->
@include('sidebar')
<!-- Sidebar End -->


<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('nav')
    <div class="container mt-5">
        <!-- Form Card -->
        <div class="card text-white" style="background-color: #222831; border-radius: 10px;"> <!-- Dark background with smooth edges -->
            <div class="card-body p-4">
                <h5 class="mb-4">Edit Post</h5>

                <!-- Form Start -->
                <form action="{{ route('post.update',['id'=>$post->id]) }}" method="POST">
                    @csrf

                    <!-- Title Input -->
                    <div class="mb-3">
                        <label for="title" class="form-label" style="color: #8892b0;">Title</label> <!-- Label color -->
                        <input type="text" class="form-control" id="title" name="title" style="background-color: #f5f7fa; color: #222831;" value="{{$post->title}}" placeholder="Enter your title" required> <!-- Light input -->
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label" style="color: #8892b0;">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" style="background-color: #f5f7fa; color: #222831;" placeholder="Enter content" required>{{$post->content }}</textarea> <!-- CKEditor will replace this -->
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-danger">Submit</button> <!-- Red submit button -->
                </form>
                <a href="{{route('post.index')}}" class="btn btn-warning mt-3">Back</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/4.25.0/standard/ckeditor.js"></script>
    <script>
        // Initialize CKEditor for the content field
        CKEDITOR.replace('content');
    </script>
    <script>
        // Show SweetAlert based on session message
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</div>
    <!-- Content End -->
    @include('foot')
