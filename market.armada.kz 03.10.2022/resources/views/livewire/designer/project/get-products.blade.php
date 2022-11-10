<div class="my-3">
    <label for="search" class="active">Выбранные продукты</label>
    <input wire:model="search" class="form-control" id="search" type="text" placeholder="Search"  />
    <div class="section__content viewed__content">
        @if($designer_project_products != null and $designer_project_products->count() > 0)
            <div class="row">
                @foreach($designer_project_products as $product)
                    <div class="col-sm-6 d-flex justify-content-center col-md-4 col-lg-3 col-xl-2 mb-2 r">
                        <div onclick="Livewire.emit('selectProducts', {{$product->id}})" class="card bg-primary" style="width: 18rem; height: 100%">
                            <img class="card-img-top" src="{{ $product->getImages(0,'images', '/img/logo-gray.png',true) }}" style="object-fit: cover" height="236" width="286" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text text-light">{{$product->title}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                @else
                        @if(count($designer_project_products) == 0 && $designer_project_products->currentPage() !=1 )
                        {{$this->gotoPage($designer_project_products->currentPage()-1)}}
                        @endif
                            <span class="text-center">{{__('messages.search.no_result')}}</span>


                @endif

                    <div class="col-12 d-flex" >
                        @if($designer_project_products->previousPageUrl() != null)
                            <div class="pagination__arrow pagination__arrow--prev " wire:click="previousPage('selected_page')"><svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.292893 7.29289C-0.097631 7.68342 -0.0976311 8.31658 0.292893 8.70711L6.65685 15.0711C7.04738 15.4616 7.68054 15.4616 8.07107 15.0711C8.46159 14.6805 8.46159 14.0474 8.07107 13.6569L2.41421 8L8.07107 2.34315C8.46159 1.95262 8.46159 1.31946 8.07107 0.928933C7.68054 0.538408 7.04738 0.538408 6.65685 0.928933L0.292893 7.29289ZM3 7L1 7L1 9L3 9L3 7Z" fill="#282C34"></path>
                                </svg></div>
                        @endif
                        @if($designer_project_products->nextPageUrl() != null)
                            <div class="pagination__arrow pagination__arrow--next" wire:click="nextPage('selected_page')"><svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.70711 8.70711C9.09763 8.31658 9.09763 7.68342 8.70711 7.29289L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928932 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L6.58579 8L0.928932 13.6569C0.538408 14.0474 0.538408 14.6805 0.928932 15.0711C1.31946 15.4616 1.95262 15.4616 2.34315 15.0711L8.70711 8.70711ZM6 9H8V7H6V9Z" fill="#282C34"></path>
                                </svg></div>
                        @endif
                    </div>
            </div>
    </div>
</div>
