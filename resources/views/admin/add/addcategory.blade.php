Add Category

<form action="/addCategory" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="col-md-6">
        <input type="text" class="form-control" name="category_name" required placeholder="Category name" >
    </div>
    <div class="col-md-6">
        <input type="text" class="form-control" name="category_description" required placeholder="Category description" >
    </div>
    <div class="col-md-6">
        <input type="file" class="form-control" name="category_image" accept="image/*" >
    </div>

    <button type="submit">Add Category</button>

</form>