<div>
    <style>
        nav svg {
            height: 20px;
        }
        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                All Coupon
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.addcoupons') }}" class="btn btn-success pull-right">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Coupon Code</th>
                                <th>Coupon Type</th>
                                <th>Coupon Value</th>
                                <th>Cart Value</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($coupons as $coupon)
                                <tbody>
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->type }}</td>
                                    @if($coupon->type == 'fixed')
                                        <td>{{ $coupon->value }}</td>
                                    @else
                                        <td>{{ $coupon->value }}</td>
                                    @endif
                                    <td>{{ $coupon->cart_value }}</td>
                                    <td>
                                        <a href="{{ route('admin.editcoupons',['coupon_id' => $coupon->id]) }}" style="font-size: 10px;">
                                            <i class="fa fa-edit fa-2x"></i>
                                        </a>
                                        <a href="#" onclick="confirm('Are you sure?') || event.stopImmediatePropagation();" wire:click.prevent="delete({{ $coupon->id }})" style="font-size: 10px;margin-left: 10px;">
                                            <i class="fa fa-times fa-2x text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        {{--                        <div class="wrap-pagination-info">--}}
                        {{ $categories->links('vendor.livewire.simple-tailwind') }}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
