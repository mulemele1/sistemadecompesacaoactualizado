@if ($errors->any())
    <div class="errors alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @foreach ($errors->all() as $error)
            <h5><i class="icon fas fa-ban error"></i>{{ $error }}</h5>
        @endforeach
    </div>
@endif
