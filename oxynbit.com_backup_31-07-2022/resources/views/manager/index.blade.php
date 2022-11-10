<x-admin-layout>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <h4 class="card-title mb-1">Приветсвую {{Auth::user()->name}}</h4>
                        <p class="text-muted mb-1">Your data status</p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="preview-list">
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-primary">
                                            <i class="mdi mdi-file-document"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow align-items-center">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Чтобы пригласить пользователя</h6>
                                            <input type="text" style="width: 90%" class="bg-dark" value="{{URL::signedRoute('invite', ['user_id' => \Illuminate\Support\Facades\Auth::user()->id])}}" id="myLink" readonly>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <button type="button" class="btn btn-primary btn-fw" onclick="copyLink()">Копировать</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-manager.invited-users-table />

    <x-slot name="script">
        <script>
            function copyLink() {
                /* Get the text field */
                var copyText = document.getElementById("myLink");

                /* Select the text field */
                copyText.select();

                /* Copy the text inside the text field */
                document.execCommand("copy");
            }
        </script>
    </x-slot>
</x-admin-layout>
