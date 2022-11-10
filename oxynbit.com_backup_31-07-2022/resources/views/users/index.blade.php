<x-admin-layout>
    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between">Order Status
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-fw">Add User</a>
                    </h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> ID </th>
                                <th> Username </th>
                                <th> Email </th>
                                <th> Roles </th>
                                <th> Created Date </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                <tr>

                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        <img src="{{ asset($user->profile_photo_url) }}" alt="image">
                                        <span class="pl-2">{{ $user->user_name }}</span>
                                    </td>

                                    <td>
                                        {{ $user->email }}
                                    </td>

{{--                                    <td>--}}
{{--                                        {{ $user->email_verified_at }}--}}
{{--                                    </td>--}}

                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $role->title }}
                                                </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $user->created_at }}
                                    </td>

                                    <td class="d-flex justify-content-around align-items-center">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info btn-icon-text">View <i class="mdi mdi-account-card-details ml-2"></i></a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-secondary btn-icon-text">Edit <i class="mdi mdi-file-check btn-icon-append"></i></a>
                                        <form class="inline-block" action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-outline-danger btn-icon-text" >Delete <i class="mdi mdi-delete"></i></button>
                                        </form>
                                    </td>
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
