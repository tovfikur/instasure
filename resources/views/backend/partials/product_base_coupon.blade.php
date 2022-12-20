
<div class="panel-heading">
    <h3 class="panel-title">Add Your Product Base Coupon</h3>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="coupon_code">Coupon code</label>
    <div class="col-lg-9">
        <input type="text" placeholder="Coupon code" id="coupon_code" name="coupon_code" class="form-control" required>
    </div>
</div>
<div class="product-choose-list">
    <div class="product-choose">
        <div class="form-group">
            <label class="col-lg-3 control-label">Category</label>
            <div class="col-lg-9">
                <select class="form-control category_id demo-select2" name="category_ids[]" required>
                    <option value="">Select One</option>
                    @foreach(\App\Model\Category::all() as $key => $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group" id="subcategory">
            <label class="col-lg-3 control-label">Sub Category</label>
            <div class="col-lg-9">
                <select class="form-control subcategory_id demo-select2" name="subcategory_ids[]" required>

                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label" for="name">Product</label>
            <div class="col-lg-9">
                <select name="product_ids[]" class="form-control product_id demo-select2" required>

                </select>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="more hide">
    <div class="product-choose">
        <div class="form-group">
            <label class="col-lg-3 control-label">Category</label>
            <div class="col-lg-9">
                <select class="form-control category_id" name="category_ids[]" onchange="get_subcategories_by_category(this)">
                    <option value="">Select One</option>
                    @foreach(\App\Model\Category::all() as $key => $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group" id="subcategory">
            <label class="col-lg-3 control-label">Subcategory</label>
            <div class="col-lg-9">
                <select class="form-control subcategory_id" name="subcategory_ids[]" onchange="get_products_by_subcategory(this)">

                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label" for="name">Product</label>
            <div class="col-lg-9">
                <select name="product_ids[]" class="form-control product_id">

                </select>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="text-right">
    <button class="btn btn-primary" type="button" name="button" onclick="appendNewProductChoose()">Add More</button>
</div>
<br>
<div class="form-group">
    <label class="col-lg-3 control-label" for="start_date">Date</label>
    <div class="col-lg-9">
        <div id="demo-dp-range">
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="form-control" name="start_date" autocomplete="off">
                <span class="input-group-addon">to</span>
                <input type="text" class="form-control" name="end_date" autocomplete="off">
            </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-8">
        <label class=" control-label">Discount</label>
        <input type="number" min="0" step="0.01" placeholder="Discount" name="discount" class="form-control" required>
    </div>
    <div class="col-lg-4">
        <label class="control-label">Discount Type</label>
        <select class="form-control" name="discount_type">
            <option value="amount">৳</option>
            <option value="percent">%</option>
        </select>
    </div>
</div>


<script type="text/javascript">

    function appendNewProductChoose(){
        $('.product-choose-list').append($('.more').html());
        $('.product-choose-list').find('.product-choose').last().find('.category_id').select2();
    }

    function get_subcategories_by_category(el){
        var category_id = $(el).val();
        console.log(category_id);
        $(el).closest('.product-choose').find('.subcategory_id').html(null);
        $.post('{{ route('admin.products.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
            for (var i = 0; i < data.length; i++) {
                $(el).closest('.product-choose').find('.subcategory_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
            $(el).closest('.product-choose').find('.subcategory_id').select2();
            get_products_by_subcategory($(el).closest('.product-choose').find('.subcategory_id'));
        });
    }

    function get_products_by_subcategory(el){
        var subcategory_id = $(el).val();
        console.log(subcategory_id);
        $(el).closest('.product-choose').find('.product_id').html(null);
        $.post('{{ route('admin.products.get_products_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
            for (var i = 0; i < data.length; i++) {
                $(el).closest('.product-choose').find('.product_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
            $(el).closest('.product-choose').find('.product_id').select2();
        });
    }

    $(document).ready(function(){
        $('.demo-select2').select2();
        //get_subcategories_by_category($('.category_id'));
    });

    $('.category_id').on('change', function() {
        get_subcategories_by_category(this);
    });

    $('.subcategory_id').on('change', function() {
        get_products_by_subcategory(this);
    });


</script>
