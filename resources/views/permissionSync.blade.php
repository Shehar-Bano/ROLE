@include('head')

<!-- Sidebar Start -->
@include('sidebar')
<!-- Sidebar End -->


<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('nav')
    <!-- Navbar End -->

    <div class="container">
        <h2 class="my-4 text-white">Assign Role to User</h2> <!-- Text color matches dark theme -->

        <!-- Form Card -->
        <div class="card  text-white" style="background-color: rgb(56, 57, 65)"> <!-- Dark card background to match the theme -->
            <div class="card-body">
                <!-- Form Start -->
                <form action="{{ route('assign.role') }}" method="POST">
                    @csrf

                    <!-- User Selection -->
                    <div class="mb-3">
                        <label for="user" class="form-label text-white">Select User</label>
                        <select id="user" name="user_id" class="form-select bg-dark text-white">
                            <option value="" disabled selected>Select a user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Role Selection -->
                    <div class="mb-3">
                        <label for="role" class="form-label text-white">Select Role</label>
                        <select id="role" name="role" class="form-select bg-dark text-white">
                            <option value="" disabled selected>Select a role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-danger">Assign Role</button> <!-- Red button for contrast -->
                </form>
            </div>
        </div>
    </div>


    <div class="container">
        <h2 class="my-4 text-white">Assign Permission to Role</h2> <!-- Text color matches dark theme -->

        <!-- Form Card -->
        <div class="card  text-white" style="background-color: rgb(56, 57, 65)"> <!-- Dark card background to match the theme -->
            <div class="card-body">
                <!-- Form Start -->
                <form action="{{ route('assign.permission') }}" method="POST">
                    @csrf

                    <!-- User Selection -->
                    <div class="mb-3">
                        <label for="role" class="form-label text-white">Select role</label>
                        <select id="role" name="role_id" class="form-select bg-dark text-white">
                            <option value="" disabled selected>Select a role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Role Selection -->
                    <div class="mb-3">
                        <label for="permission" class="form-label text-white">Select permission</label>
                        <select id="permission" name="permission_id" class="form-select bg-dark text-white">
                            <option value="" disabled selected>Select a permission</option>
                            @foreach ($permissions as $permission)

                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-danger">Assign permission</button> <!-- Red button for contrast -->
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
