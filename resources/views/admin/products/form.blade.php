
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label>English Name</label>
            <input type="text" name="name_en" placeholder="English Name" class="form-control" value="{{ $product->name_en }}" />
        </div>

    </div>
    <div class="col-md-6">

        <div class="mb-3">
            <label>Arabic Name</label>
            <input type="text" name="name_ar" placeholder="Arabic Name" class="form-control"  value="{{ $product->name_ar }}"/>
        </div>
    </div>
</div>


<div class="mb-3">
    <label for="image">Image</label>
    <input type="file" id="image" name="image" class="form-control" />
    @if ($product->image)
        <img width="80" src="{{ asset('uploads/products/'.$product->image) }}" alt="">
    @endif

</div>

<div class="mb-3">
    <label for="album" >Album</label>
    <input type="file" id="album" name="album[]" multiple class="form-control"  />
    @foreach ($product->album as $img)
        <a href="{{ route('admin.products.delete_image', $img->id) }}">Delete</a>
        <img width="60" src="{{ asset('uploads/products/'.$img->path) }}" alt="">
    @endforeach
</div>

<div class="mb-3">
    <label>English Content</label>
    <textarea name="content_en" placeholder="English Content" class="myeditor">{{ $product->content_en }}</textarea>
</div>

<div class="mb-3">
    <label>Arabic Content</label>
    <textarea name="content_ar" placeholder="Arabic Content" class="myeditor">{{ $product->content_ar }}</textarea>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label for="price" >Price</label>
            <input type="text" id="price" name="price" class="form-control"  placeholder="price" value="{{ $product->price}}"/>
        </div>

    </div>
    <div class="col-md-4">

        <div class="mb-3">
            <label for="sale_price" >Sale Price</label>
            <input type="text" id="sale_price" name="sale_price" class="form-control"  placeholder="sale price" value="{{ $product->sale_price}}"/>
        </div>
    </div>
    <div class="col-md-4">


        < class="mb-3">
            <label for="quantity" >Quantity</label>
            <input type="text" id="quantity" name="quantity" class="form-control"  placeholder="quantity" value="{{ $product->quantity}}"/>
        </ div>
    </div>
</div>



<div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control">
        <option value="">Select</option>
        @foreach ($categories as $item)
            <option @selected($product->category_id == $item->id) value="{{ $item->id }}">{{ $item->trans_name }}</option>
        @endforeach
    </select>
</div>
