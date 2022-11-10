<x-app-layout>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create API Key</h4>
            </div>
            <div class="card-body">

                <div class="row col-xl-6" style="margin-left: -11px;">
                    <div class="col-xl-4 col-md-4" style="margin-bottom: -20px;">
                        <div class="form-group">
                            <label class="mr-sm-2">
                                <input type="checkbox" class="form-check-input" checked="" disabled=""> Read data
                            </label>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-8" style="margin-bottom: -20px;">
                        <div class="form-group">
                            <label class="mr-sm-2">
                                <input type="checkbox" class="form-check-input" id="ApiWithdrawCB"> Withdraw balance
                            </label>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="form-group">
                            <label class="mr-sm-2">
                                <input type="checkbox" class="form-check-input" id="ApiSpotCB"> Spot trading
                            </label>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-8">
                        <div class="form-group">
                            <label class="mr-sm-2">
                                <input type="checkbox" class="form-check-input" id="ApiMarginCB"> Margin trading
                            </label>
                        </div>
                    </div>

                </div>

                <button class="btn btn-primary" id="ApiCreateBtn">Create API Key</button>

            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Your API Keys</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Key</th>
                            <th>Permissions</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="ApiTbody">

                        <tr><td></td><td></td><td>At the moment you do not have created api keys</td><td></td><td></td><td></td></tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
