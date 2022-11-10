<div class="card">
    <div class="card-body">
        <h4 class="card-title">Приглашенные пользователи</h4>
        </p>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th> User </th>
                    <th> User name </th>
                    <th> Registered date </th>
                </tr>
                </thead>
                <tbody>

                @foreach($user->invitedUsers()->get() as $invited_user)

                <tr>
                    <td class="py-1">
                        <img src="{{asset($invited_user->profile_photo_url)}}" alt="{{$invited_user->name}}">
                    </td>
                    <td> {{$invited_user->user_name}} </td>
                    <td> {{$invited_user->created_at}}  </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
