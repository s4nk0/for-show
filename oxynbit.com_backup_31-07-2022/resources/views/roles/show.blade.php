<x-admin-layout>
    <div class="row ">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$role->title}}</h4>
                    <p class="card-description"> Edit form </p>
                    <form method="post" class="forms-sample" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="exampleInputid1">ID</label>
                            <input type="text" class="form-control bg-dark" id="exampleInputid1" placeholder="Null" value="{{$role->id}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCreate1">Created at</label>
                            <input type="text" class="form-control bg-dark" id="exampleInputCreate1" placeholder="Null" value="{{$role->created_at}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUpdate1">Updated at</label>
                            <input type="text" class="form-control bg-dark" id="exampleInputUpdate1" placeholder="Null" value="{{$role->updated_at}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTitle1">Title</label>
                            <input type="text" name="title" class="form-control bg-dark" id="exampleInputTitle1" placeholder="Null" value="{{$role->title}}">
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
                    @if($role->permissions->toArray() != null && ($role->permissions->toArray()[array_search($permission->id,array_column($role->permissions->toArray(),'id'))]['id']== $permission->id)) selected: true, @endif
                    description: '{{$permission->description}}',
                 },
                @endforeach
            ];

            function formatState (state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    "<span>"+state.text + " - " + state.description+"</span>"
                );

                return $state;
            };

            $(".js-example-basic-multiple").select2({
                data: data,
                templateResult: formatState,
            })

        </script>
    </x-slot>
</x-admin-layout>
