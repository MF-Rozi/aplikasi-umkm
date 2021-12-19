  <form action="{{ $action }}" method="POST" name="createProduct" enctype="multipart/form-data">
    @csrf
    @method($method)
    <div class="form-group">
      <label for="name" class="form-control-label">Product Name <span style="color: red">*</span>
      </label>
      <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Enter Product Name" value="{{ !empty($productDetail) ? $productDetail->name :  old('name')}}">
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="price" class="form-control-label">Product Price <span style="color: red">*</span>
      </label>
      <input class="form-control @error('price') is-invalid @enderror" type="number" name="price" id="price" placeholder="Enter Product Price" value="{{ !empty($productDetail) ?  $productDetail->price : old('price') }}">

      @error('price')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="stock" class="form-control-label">Product Stock <span style="color: red">*</span>
      </label>
      <input class="form-control @error('stock') is-invalid @enderror" type="number" name="stock" id="stock" placeholder="Enter Product Stock" value="{{ !empty($productDetail) ?  $productDetail->stock : old('stock') }}">

      @error('stock')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="code" class="form-control-label">Product Code <span style="color: red">*</span>
      </label>
      <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" id="code" placeholder="Enter Product Code" value="{{ !empty($productDetail) ?  $productDetail->code : old('code') }}">

      @error('code')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">

      <label for="category" class="form-control-label">Category</label>
      <select class="form-control @error('category')
                            is-invalid
                        @enderror" id="category" name="category">
        <option value="{{ !empty($productDetail) ? (empty($productDetail->categories->first()) ? 'selected' : '') : '' }}"> None</option>



        @foreach ($categories as $cat)

        <option value="{{ $cat->id }}" {{ !empty($productDetail) ? (empty($productDetail->categories->first()) ? '' : ($productDetail->categories->first()->id == $cat->id ? 'selected' : '') ):'' }}>


          {{ $cat->name }}</option>
        @endforeach

      </select>
      @error('parent')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>


    <div class="form-group">
      <label for="picture" class="form-control-label">Product Picture <span style="color: red">*</span></label>

      <div class="needsclick dropzone" id="product-picture-dropzone"></div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
  </form>


@section('script-body')
<script>
  var uploadedDocumentMap = {};
  window.Dropzone.options.productPictureDropzone = {
    url: "{{ route('admin.product.upload.picture') }}"
    , addRemoveLinks: true
    , maxFilesize: {{ config('media-library.max_file_size') / (1024 * 1024 )}}
    , maxFiles: 5
    , headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
    , success: function(file, response) {
      $('form').append('<input type="hidden" name="productPicture[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    }
    , removedfile: function(file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="productPicture[]"][value="' + name + '"]').remove()
    }
    , init: function() {
      @if(isset($project) && $project->document)
      var files = {
        !!json_encode($project->document) !!
      }
      for (var i in files) {
        var file = files[i]
        this.options.addedfile.call(this, file)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
      }
      @endif
    }

  }

</script>
@endsection
