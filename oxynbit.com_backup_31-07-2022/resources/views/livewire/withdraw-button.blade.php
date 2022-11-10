@if(count($user->roles()->where('title','Admin')->get()) > 0)
    <button style="padding: 7px 15px 7px 15px;" class="btn btn-primary text-light" ><i class="mdi mdi-forward">&nbsp;&nbsp;</i>Withdraw Now</button>
@else
    <a  onclick="Livewire.emit('openModal', 'user.verification-modal')" style="padding: 7px 15px 7px 15px;" class="btn btn-primary text-light" ><i class="mdi mdi-forward">&nbsp;&nbsp;</i>Withdraw Now</a>
@endif
