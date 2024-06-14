@extends('admin.layouts.mater')
@section('title')
    Thêm mới sản phẩm
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
 <form action="{{ route('admin.products.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>

                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <div>
                                    <label for="basiInput" class="form-label">name</label>
                                    <input type="text" name="name" class="form-control" id="basiInput">
                                </div>
                                <div>
                                    <label for="basiInput" class="form-label">sku</label>
                                    <input type="text" name="sku" class="form-control" id="basiInput"
                                        value="{{ strtoupper(Str::random(8)) }}">
                                </div>
                                <div>
                                    <label for="basiInput" class="form-label">catelogues</label>
                                    <select type="text" name="catelogue_id" class="form-select" id="basiInput">
                                        @foreach ($catelogues as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="img_thumbnail" class="form-label">img_thumbnail</label>
                                    <input type="file" name="img_thumbnail" class="form-control" id="img_thumbnail">
                                </div>
                                <div>
                                    <label for="price_regular" class="form-label">price_regular</label>
                                    <input type="number" name="price_regular" class="form-control" id="price_regular">
                                </div>
                                <div>
                                    <label for="price_sale" class="form-label">price_sale</label>
                                    <input type="number" name="price_sale" class="form-control" id="price_sale">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check form-switch form-switch-warning">
                                            <input class="form-check-input" type="checkbox" name="is_active" role="switch"
                                                id="SwitchCheck2" checked>
                                            <label class="form-check-label" for="SwitchCheck2">is_active</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-switch form-switch-secondary">
                                            <input class="form-check-input" type="checkbox" name="is_hot_deal"
                                                role="switch" id="SwitchCheck2" checked>
                                            <label class="form-check-label" for="SwitchCheck2">is_hot_deal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-switch form-switch-primary">
                                            <input class="form-check-input" type="checkbox" name="is_good_deal"
                                                role="switch" id="SwitchCheck2" checked>
                                            <label class="form-check-label" for="SwitchCheck2">is_good_deal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-switch form-switch-info">
                                            <input class="form-check-input" type="checkbox" name="is_new" role="switch"
                                                id="SwitchCheck2" checked>
                                            <label class="form-check-label" for="SwitchCheck2">is_new</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input" type="checkbox" name="is_show_home"
                                                role="switch" id="SwitchCheck2" checked>
                                            <label class="form-check-label" for="SwitchCheck2"> is_show_home</label>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div>
                                                <label for="description" class="form-label">description</label>
                                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                            </div>
                                            <div>
                                                <label for="description" class="form-label">material</label>
                                                <textarea class="form-control" id="description" name="material" rows="4"></textarea>
                                            </div>
                                            <div>
                                                <label for="user_manual" class="form-label">user_manual</label>
                                                <textarea class="form-control" id="user_manual" name="user_manual" rows="4"></textarea>
                                            </div>
                                            <div>
                                                <label for="content" class="form-label">content</label>
                                                <textarea class="form-control" id="content" name="content"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>


                        </div>
                        <!--end row-->
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->

    </div>
    <div class="row" style="height: 300px;overflow: scroll">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>

                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <table>
                                <tr>
                                    <th>size</th>
                                    <th>color</th>
                                    <th>quantity</th>
                                    <th>image</th>
                                </tr>
                                @foreach ($sizes as $sizeId => $sizeName)
                                    @foreach ($colors as $colorId => $colorName)
                                        <tr>
                                            <td>{{ $sizeName }}</td>
                                            <td>{{ $colorName }}</td>
                                            <td><input type="text" class="form form-control"
                                                    name="product_variants[{{ $sizeId . '-' . $colorId }}][quatity]"
                                                    placeholder="số lượng" value="12"></td>
                                            <td><input type="file" class="form form-control"
                                                    name="product_variants[{{ $sizeId . '-' . $colorId }}][image]"
                                                    id=""></td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>



                        </div>
                        <!--end row-->
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">gallery</h4>

                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <div>
                                    <label for="gallery_1" class="form-label">Gallery 1</label>
                                    <input type="file" name="product_galleries[]" class="form-control"
                                        id="gallery_1">
                                </div>
                                <div>
                                    <label for="galler_2" class="form-label">Gallery 2</label>
                                    <input type="file" name="product_galleries[]" class="form-control"
                                        id="galler_2">
                                </div>

                            </div>



                        </div>
                        <!--end row-->
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">gallery</h4>

                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <div>
                                    <label for="tags" class="form-label">Tags</label>
                                    <select name="tags[]" multiple class="form-control" id="tags">
                                        @foreach ($tags as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>



                        </div>
                        <!--end row-->
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <button type="submit" class="btn btn-primary">Save</button>

                </div><!-- end card header -->
                
            </div>
        </div>
        <!--end col-->

    </div>
 </form>
@endsection
@section('script-libs')
    <script src="//cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection
@section('scripts')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
