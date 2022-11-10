<x-admin-layout>
    <div class="row ">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Role</h4>
                    <p class="card-description"> add form </p>
                    <form method="post" class="forms-sample" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputTitle1">Title</label>
                            <input type="text" name="title" class="form-control bg-dark" id="exampleInputTitle1" placeholder="Title">
                        </div>
                        @error('title')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label>Permissions</label>
                            <select name="permissions[]" class="js-example-basic-multiple" multiple="multiple" style="width:100%">

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>


                </div>
            </div>
        </div>
    </div>



    <x-slot name="plugin_css">
        <link rel="stylesheet" href="{{asset('admin/assets/vendors/select2/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
    </x-slot>

    <x-slot name="plugin_script">
        <script src="{{asset('admin/assets/vendors/select2/select2.min.js')}}"></script>
    </x-slot>

    <x-slot name="script">
        <script src="{{asset('admin/assets/js/select2.js')}}"></script>
        <script>
            var data = [
                    @foreach($permissions as $permission)
                {
                    id: {{$permission->id}},
                    text: '{{$permission->title}}',
                },
                @endforeach
            ];
            $(".js-example-basic-multiple").select2({
                data: data
            })

        </script>
    </x-slot>
</x-admin-layout>
