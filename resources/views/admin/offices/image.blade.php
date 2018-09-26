<image-component :attributes="{{ $image }}" inline-template class="col-sm-4 float-left">

    <div id="image-{{ $image->id }}" class="p-0">

        <div class="card card-body bg-light">
            <span class="admin-image-delete" @click="destroy">
                <i class="fa fa-times-circle-o" aria-hidden="true"></i>
            </span>

            <img src="{{ asset('/storage/images/offices/'.$image->path) }}" alt="Card image cap"  class="img-fluid">
        </div>
    </div>
 
</image-component>