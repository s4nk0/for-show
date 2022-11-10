<x-app-layout>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Terms of Service </h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="textinfo">
                        <div class="usolyes">
                            {!! \Illuminate\Mail\Markdown::parse(file_get_contents(resource_path('markdown/terms.md'))); !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="car"> </div>
            </div>
        </div>
    </div>
</x-app-layout>
