@extends('admin.layouts.mater')
@section('title')
    Thêm mới Danh mục sản phẩm
@endsection
@section('content')
<form action="{{route('admin.catalogues.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-6">
      
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"></div>
            <div class="mb-3 mt-3">
                <label for="cover" class="form-label">File:</label>
                <input type="file" class="form-control" id="cover" name="cover">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check mb-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1" name="is_active" checked> is_active
                </label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
