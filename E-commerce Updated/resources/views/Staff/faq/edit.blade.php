@extends('Staff.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>FAQ</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update FAQ</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('faq.update', $faq->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="title" value="{{ $faq->title }}">
                                </div>
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="description" class="form-control summernote">{{ $faq->description }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Update FAQ</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection


