@extends('admin.layouts.mater')
@section('title')
    Xem chi tiết danh mục sản phẩm
@endsection
@section('content')
<table class="table table-hover">
    <tr>
        <th>Trường</th>
        <th>Giá trị</th>
    </tr>
    @foreach ($model->toArray() as $key => $value)
    {{-- @dd($key) --}}
        <tr>
            <td>{{ $key }}</td>
            <td>
                @php
                    if ($key == 'cover'){
                            $url=Storage::url($value);
                            echo "<img src=\"$url\" alt=\"\" width=\"50px\">";
                    }elseif (Str::contains($key,'is_')) {
                        echo $value ? '<span class="badge bg-primary">YES</span>': '<span class="badge bg-danger">NO</span>';
                    }else{
                        echo $value;
                    };
                @endphp
            </td>
        </tr>
    @endforeach
</table>
@endsection
