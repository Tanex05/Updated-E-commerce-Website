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
                            <h4>Create FAQ</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('faq.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="title" value="">
                                </div>
                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="description" class="form-control summernote"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Create FAQ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

