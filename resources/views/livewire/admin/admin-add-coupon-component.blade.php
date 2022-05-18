<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            Add New Coupon
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.categories') }}" class="btn btn-success pull-right">All Coupon</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <form class="form-horizontal" wire:submit.prevent="storeCoupon">
                        <div class="form-group">
                            <label for="code" class="col-md-4 control-label">Coupon Code</label>
                            <div class="col-md-4" wire:key="input-name-2">
                                <input type="text" placeholder="Coupon Code" id="code" class="form-control input-md" wire:model="code">
                                @error('code') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">Coupon Type</label>
                            <div class="col-md-4">
                                <select class="form-control" wire:model="type">
                                    <option value="fixed">Fixed</option>
                                    <option value="precent">Precent</option>
                                </select>
                                @error('type') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="value" class="col-md-4 control-label">Coupon Value</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Coupon Value" id="value" class="form-control input-md" wire:model="value">
                                @error('value') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cart_value" class="col-md-4 control-label">Cart Value</label>
                            <div class="col-md-4">
                                <input type="text" placeholder="Cart Value" id="cart_value" class="form-control input-md" wire:model="cart_value">
                                @error('cart_value') <div class="error" style="color: red;">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
