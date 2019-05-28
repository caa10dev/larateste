@if ($errors->any())
<div class="alert alert-warning alert-dismissible">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif

@if (session('warning'))
<div class="alert alert-warning alert-dismissible">
	{{ session('warning') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
	{{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible">
	{{ session('error') }}
</div>
@endif