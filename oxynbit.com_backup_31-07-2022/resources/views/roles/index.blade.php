<x-admin-layout>
    <div class="row ">
        <div class="col-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between">Roles
                        <a href="{{ route('roles.create') }}" class="btn btn-outline-primary btn-fw">Add Role</a>
                    </h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> ID </th>
                                <th> Title </th>
                                <th> Created at </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($roles as $role)
                                <tr class="btn btn-outline-secondary btn-lg btn-block border-0 p-0 m-0 d-table-row text-left" onclick="window.location='{{ route("roles.show",$role->id) }}'">

                                    <td class="border-0">
                                        {{ $role->id }}
                                    </td>

                                    <td class="border-0">
                                        {{ $role->title }}
                                    </td>

                                    <td class="border-0">
                                        {{ $role->created_at }}
                                    </td>

{{--                                    <td class="d-flex justify-content-around align-items-center">--}}
{{--                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info btn-icon-text">View <i class="mdi mdi-account-card-details ml-2"></i></a>--}}
{{--                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-secondary btn-icon-text">Edit <i class="mdi mdi-file-check btn-icon-append"></i></a>--}}
{{--                                        <form class="inline-block" action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">--}}
{{--                                            <input type="hidden" name="_method" value="DELETE">--}}
{{--                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                            <button type="submit" class="btn btn-outline-danger btn-icon-text" >Delete <i class="mdi mdi-delete"></i></button>--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between">Permissions
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-fw">Add Permissions</a>
                    </h4>
                    <p class="card-description"> For developers </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> ID </th>
                                <th> Title </th>
                                <th> Description </th>
                                <th> Created at </th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($permissions as $permission)
                                <tr class="btn btn-outline-secondary btn-lg btn-block border-0 p-0 m-0 d-table-row text-left">

                                    <td>
                                        {{ $permission->id }}
                                    </td>

                                    <td>
                                        {{ $permission->title }}
                                    </td>

                                    <td>
                                        {{ $permission->description }}
                                    </td>

                                    <td>
                                        {{ $permission->created_at }}
                                    </td>


                                    {{--                                    <td class="d-flex justify-content-around align-items-center">--}}
                                    {{--                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info btn-icon-text">View <i class="mdi mdi-account-card-details ml-2"></i></a>--}}
                                    {{--                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-secondary btn-icon-text">Edit <i class="mdi mdi-file-check btn-icon-append"></i></a>--}}
                                    {{--                                        <form class="inline-block" action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">--}}
                                    {{--                                            <input type="hidden" name="_method" value="DELETE">--}}
                                    {{--                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                    {{--                                            <button type="submit" class="btn btn-outline-danger btn-icon-text" >Delete <i class="mdi mdi-delete"></i></button>--}}
                                    {{--                                        </form>--}}
                                    {{--                                    </td>--}}
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
