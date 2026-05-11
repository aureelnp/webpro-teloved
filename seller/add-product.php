<form action="../api/products/addProduct.php" method="POST">

    <input
        type="text"
        name="product_name"
        placeholder="Product Name"
    >

    <br><br>

    <textarea
        name="description"
        placeholder="Description"
    ></textarea>

    <br><br>

    <input
        type="number"
        name="price"
        placeholder="Price"
    >

    <br><br>

    <button type="submit">
        Add Product
    </button>

</form>