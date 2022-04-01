<div>
    <div class="container" style="padding: 150px 150px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage Home Categories
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <form action="" class="form-horizontal" wire:submit.prevent="updateHomeCategory">
                            <div class="form-group">
                                <label for="selectCategory" class="col-md-4 control-label" >Choose Category</label>
                                <div class="col-md-4" wire:ignore>
                                    <select name="categories[]" multiple="multiple" class="sel_categories form-control" wire:model="sel_categories">
                                        <option value="">Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('sel_categories') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_products" class="col-md-4 control-label" >No. of Products</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-md" id="no_products" wire:model="numberofproducts">
                                    @error('numberofproducts') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_products" class="col-md-4 control-label" ></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function (){
            $('.sel_categories').select2();
            $('.sel_categories').on('change',function(e){
                var data = $('.sel_categories').select2("val");
                @this.set('selected_categories',data);
            });
        });
    </script>
@endpush
