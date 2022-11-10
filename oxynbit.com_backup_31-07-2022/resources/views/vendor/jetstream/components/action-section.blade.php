<div {{ $attributes->merge(['class' => 'row mt-6 sm:mt-0']) }}>

    <div class="card-header col-lg-6">
        <h4 class="card-title">{{ $title }}</h4>
{{--        <h4 class="card-title">{{ $description }}</h4>--}}
    </div>

    <div class="md:col-span-2 bg-gray-600 h-100 col-lg-6 border-bottom">
        @isset($href)
            <a name="{{ $href }}" ></a>
        @endisset
        <div class="px-4 py-5 sm:p-6 ">
            {{ $content }}
        </div>
    </div>
</div>

