@forelse ($data as $index => $item)
    <div class="col-12 col-md-4 col-size bg-white rounded border p-2 mb-1 margin-col">
        <div class="item-container">
            <div class="image-container my-1 text-center">
                <img src="{{ asset('storage/supply/' . $item->images->parent_folder . '/' . $item->images->path) }}"
                    class="img-fluid product-image btn-show-image" alt="gambar alat tulis" data-bs-toggle="modal"
                    data-bs-target="#imageModal" data-item-id="{{ $item->id }}">
            </div>
            <h5 class="text-center font-bold p-0 m-0">{{ $item->name }}</h5>

            <button class="btn btn-primary btn-sm btn-full-width my-1 btn-book" data-item-id="{{ $item->id }}">
                Add To Cart
            </button>
        </div>
    </div>

@empty
    <div class="col-12 text-center my-auto p-2  ">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-sad" width="64"
            height="64" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
            <path d="M9 10l.01 0"></path>
            <path d="M15 10l.01 0"></path>
            <path d="M9.5 15.25a3.5 3.5 0 0 1 5 0"></path>
        </svg>
        <h1 class="mt-1">Tiada Alat Tulis Dijumpai</h1>
    </div>
@endforelse
