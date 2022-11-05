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
                            <span>{{ !empty($cid) ? 'Update Category' : 'Create Category' }}</span>
                        </h5>
                        <ol class="breadcrumbs">
                            <li class="breadcrumb-item">
                                <a href="{{ route('category_list') }}">Categories</a>
                            </li>
                            <li class="breadcrumb-item active" style="color: purple">
                                {{ !empty($cid) ? 'Update Category' : 'Create Category' }}
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
                        action="{{ URL('update_category') }}">
                        @csrf

                        <input type="hidden" name="cid" value="{{ $cid }}">
                        <div class="row flexClass">
                            <div class="input-field col s4 alignSelfCenter">
                                {{-- <i class="material-icons prefix">mail</i> --}}
                                <input id="category_name" type="text" class="validate" name="category_name"
                                    value="{{ !empty($data) ? $data->category_name : '' }}">
                                <label for="category_name">Category name</label>
                            </div>
                            <div class="input-field col s4">
                                <div class="file-field input-field">
                                    <div class="btn green">
                                        <span>File</span>
                                        <input type="file" name="logo_img">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" name="logo"
                                            value="{{ !empty($data->file_name) ? $data->file_name : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="input-field col s4 alignSelfCenter">
                                <div class="switch">
                                    <label>
                                        Inactive
                                        <input type="checkbox" {{ empty($data->status) ? 'checked' : '' }}
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
                    category_name: "required",
                },
                messages: {
                    category_name: "Please enter Category Name",
                },
            });

        });
    </script>
</x-admin-layout>
