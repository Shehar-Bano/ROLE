@include('head')

<!-- Sidebar Start -->
@include('sidebar')
<!-- Sidebar End -->


<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('nav')
    <div class="container mt-5">

        <!-- Add Post Button -->
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('post.form') }}" class="btn btn-primary">Add Post</a>
        </div>

        <!-- Posts Table -->
        <div class="card text-white" style="background-color: #222831; border-radius: 10px;">
            <div class="card-body p-4">
                <h5 class="mb-4">Post List</h5>

                <!-- Table Start -->
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{!! Str::limit($post->content, 50) !!} <!-- Limit content length for display --></td>
                                <td class="text-center">
                                    <!-- Edit Button -->
                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                    </a>

                                    <!-- Delete Form -->
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> <!-- Delete Icon -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No posts found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Table End -->
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert for Delete Confirmation (Optional)
        document.querySelectorAll('form').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
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


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @include('foot')
