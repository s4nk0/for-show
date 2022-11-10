<button {{ $attributes }}
        @if(session('verification') != 'accepted' || session('verification') == null)
        onclick="Livewire.emit('openModal', 'user.verification-modal')" @endif  style="padding: 7px 15px 7px 15px;" class="btn btn-primary" ><i class="mdi mdi-forward">&nbsp;&nbsp;</i>Withdraw Now</button>

