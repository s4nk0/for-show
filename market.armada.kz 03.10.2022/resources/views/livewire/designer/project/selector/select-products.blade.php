<span>
@foreach($products_id as $ids)
        <input type="hidden" name="products_id[]" value="{{$ids}}">
    @endforeach
</span>
