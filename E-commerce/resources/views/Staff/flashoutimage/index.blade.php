@extends('Staff.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Background FlashOut Image</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Upload or Update Background Image</h4>
                        </div>
                        <div class="card-body">
                            @if($FlashOutbackgroundImage)
                                <h5>Existing Image:</h5>
                                <img src="{{ asset($FlashOutbackgroundImage->image_path) }}" alt="Existing Background Image" class="img-fluid mb-3">
                            @else
                                <p>No background image found for Flash Out.</p>
                            @endif
                            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($FlashOutbackgroundImage)
                                    @method('PUT')
                                @endif
                                <div class="form-group">
                                    <label for="image">Select Image:</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload/Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
