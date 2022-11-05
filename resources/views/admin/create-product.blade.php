<x-admin-layout>
    <style>
        .scrollspy {
            overflow-x: auto;
        }
    </style>
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-green-teal">
        </div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0">
                            <span>{{ !empty($pid) ? 'Update Product' : 'Create Product' }}</span>
                        </h5>
                        <ol class="breadcrumbs">
                            <li class="breadcrumb-item">
                                <a href="{{ route('product_list') }}">Products</a>
                            </li>
                            <li class="breadcrumb-item active" style="color: purple">
                                {{ !empty($pid) ? 'Update Product' : 'Create Product' }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l12">
            <div id="responsive-table" class="card card card-default scrollspy">
                <div class="card-content">
                    <form method="POST" id="form_create_product" enctype="multipart/form-data"
                        action="{{ URL('update_product') }}">
                        @csrf

                        <input type="hidden" name="pid" value="{{ $pid }}">
                        <div class="row flexClass">
                            <div class="input-field col s6">
                                <select name="cid" id="cid">
                                    @if($pid != 0)
                                        @foreach($categories as $val)
                                            <option value="{{$val->cid}}" {{ $products->cid == $val->cid ? 'selected' : '' }}>{{$val->category_name}}</option>
                                        @endforeach
                                    @else
                                        @foreach($categories as $val)
                                            <option value="{{$val->cid}}" >{{$val->category_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label>Select Category</label>
                            </div>
                            <div class="input-field col s6">
                                {{-- <i class="material-icons prefix">mail</i> --}}
                                <input id="product_name" type="text" class="validate" name="product_name"
                                    value="{{ !empty($products) ? $products->product_name : '' }}">
                                <label for="product_name">Product name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="product_rate" type="number" class="validate" name="product_rate"
                                    value="{{ !empty($products) ? $products->product_rate : '' }}">
                                <label for="product_rate">Product Price</label>
                            </div>
                            <div class="input-field col s6">
                                <textarea id="textarea1" class="materialize-textarea" name="description">{{ !empty($products->description) ? $products->description : '' }}</textarea>
                                <label for="textarea1">Product Description</label>
                            </div>
                        </div>
                        <div class="row flexClass">
                            <div class="input-field col s6">
                                <div class="file-field input-field">
                                    <div class="btn green">
                                        <span>File</span>
                                        <input type="file" name="logo_img">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" name="logo"
                                            value="{{ !empty($products->file_name) ? $products->file_name : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="input-field col s6 alignSelfCenter">
                                <div class="switch">
                                    <label>
                                        Inactive
                                        <input type="checkbox" {{ empty($products->status) ? 'checked' : '' }}
                                            name="status" class="green">
                                        <span class="lever"></span>
                                        Active
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row flexClass">
                            <div class="input-field col s12">
                                <button class="btn green waves-effect waves-light right" type="submit"
                                    name="action">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $("#form_create_product").validate({
                rules: {
                    cid: "required",
                    product_name: "required",
                    product_rate: "required",
                },
                messages: {
                    cid: "Please add Category",
                    product_name: "Please enter Product Name",
                    product_rate: "Please enter Product Price",
                },
            });

        });
    </script>
</x-admin-layout>
