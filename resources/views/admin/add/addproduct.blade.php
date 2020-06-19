Add product

<form action="/addProduct" method="POST" enctype="multipart/form-data">

    @csrf

    <input type="hidden" name="category_id" required value="{{ $categoryid }}" >

    <div class="col-md-6">
        <input type="text" class="form-control" name="product_name" required placeholder="Product name" >
    </div>
    <div class="col-md-6">
        <input type="text" class="form-control" name="product_description" required placeholder="Product description" >
    </div>
    <div class="col-md-6">
        <input type="file" class="form-control" name="product_image" accept="image/*" >
    </div>

    <label>Product Codes:</label>
    <div class="col-md-6">
        <input type="number" class="form-control" name="product_code_sku" placeholder="SKU:">
    </div>
    <div class="col-md-6">
        <input type="number" class="form-control" name="product_code_mpn" placeholder="MPN:">
    </div>

    <div class="col-md-6">
        <input type="number" class="form-control" name="product_code_gtin" placeholder="GTIN:">
    </div>

    <div class="col-md-6">
        <input type="number" class="form-control" name="product_code_upc" placeholder="UPC:">
    </div>

    <div class="col-md-6">
        <input type="number" class="form-control" name="product_code_ean" placeholder="EAN:">
    </div>

    <div class="col-md-6">
        <input type="number" class="form-control" name="product_code_isbn" placeholder="ISBN:">
    </div>
    <label>Additional fields:</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="product_extension_1" placeholder="Extension 1:">
    </div>
    <div class="col-md-6">
        <input type="text" class="form-control" name="product_extension_2" placeholder="Extension 2:">
    </div>
    <div class="col-md-6">
        <input type="text" class="form-control" name="network" placeholder="Network:">
    </div>
    <label>Pricing:</label>
    <div class="col-md-6">
        <label><input type="number" class="form-control" name="price_new" placeholder="New:">£</label>
    </div>
    <div class="col-md-6">
        <label><input type="number" class="form-control" name="price_working_a" placeholder="Working A:">£</label>
    </div>
    <div class="col-md-6">
        <label><input type="number" class="form-control" name="price_working_b" placeholder="Working B:">£</label>
    </div>
    <div class="col-md-6">
        <label><input type="number" class="form-control" name="price_working_c" placeholder="Working C:">£</label>
    </div>
    <div class="col-md-6">
        <label><input type="number" class="form-control" name="price_faulty" placeholder="Faulty:">£</label>
    </div>
    <div class="col-md-6">
        <label><input type="number" class="form-control" name="price_damaged" placeholder="Damaged/Recycle:">£</label>
    </div>
    <label>Quantity</label>
    <div class="col-md-6">
        <input type="number" class="form-control" name="quantity" placeholder="Quantity:">
    </div>
    <button type="submit">Add Category</button>

</form>