<form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Input Nama -->
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
        <div class="col-md-6">
            <input type="text" id="name" class="form-control" name="name" required autofocus>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Input Email -->
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
        <div class="col-md-6">
            <input type="email" id="email" class="form-control" name="email" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Input Password -->
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
        <div class="col-md-6">
            <input type="password" id="password" class="form-control" name="password" required>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Input Foto -->
    <div class="form-group row">
        <label for="photo" class="col-md-4 col-form-label text-md-right">Photo</label>
        <div class="col-md-6">
            <input type="file" id="photo" class="form-control" name="photo" accept="image/*">
            @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Tombol Submit -->
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </div>
</form>

