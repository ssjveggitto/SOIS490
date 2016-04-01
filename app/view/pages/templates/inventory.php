<table class="table table-striped table-hover ">
    <div class="jumbotron" id="inventory-form-container">

        <content>
            <h4 class="inventory-form-headers">Daily Activities</h4>
            <a href="#" class="btn btn-default btn-sm">Opening Count</a>
            <a href="#" class="btn btn-default btn-sm">Closing Count</a>
            <a href="#" class="btn btn-default btn-sm">Today's Report</a>
        </content>
        <content>
            <h4 class="inventory-form-headers">Reports</h4>
            <a href="#" class="btn btn-default btn-sm">View Daily Reports</a>
            <a href="#" class="btn btn-default btn-sm">View Current Stock</a>
            <a href="#" class="btn btn-default btn-sm">View Audit Reports</a>
        </content>
        <content>
            <h4 class="inventory-form-headers">Auditing</h4>
            <a href="#" class="btn btn-default btn-sm">Perform Audit</a>
            <a href="#" class="btn btn-default btn-sm">Current Audit Report</a>
            <a href="#" class="btn btn-default btn-sm">Update Product List</a>
        </content>
    </div>
    <form name="inventory-form" id="inventory-form" class="jumbotron">
        <fieldset id="inventory-filter">

            <legend>Filter Results <span id="icon-toggler" onclick="$('main .form-group').toggle('slow');"> <img src="app/view/img/icons/toggle_on-icon.png"/><img src="app/view/img/icons/toggle_off-icon.png" style="display:none"/></span></legend>
            <br>
            <div class="form-group">
                <label for="select" class="control-label">Brands</label>
                <select class="form-control" id="select">
                    <option>All</option>
                    <option>Goldwell</option>
                    <option>Morgan Taylor Polish</option>
                    <option>Moroccin</option>
                    <option>Unite</option>
                </select>
            </div>
            <div class="form-group">
                <label for="select" class="control-label">Vendors</label>
                <select class="form-control" id="select">
                    <option>All</option>
                    <option>Premier Beauty Systems</option>
                    <option>Beauty Craft</option>
                    <option>National Salon Services</option>
                </select>
            </div>
            <div class="form-group">
                <label for="select" class="control-label">Status</label>
                <select class="form-control" id="select">
                    <option>All</option>
                    <option>In-Stock</option>
                    <option>Ordered</option>
                    <option>Out-of-Stock</option>
                    <option>Shipped</option>
                </select>
            </div>
            <div class="form-group">
                <label for="select" class="control-label">Categories</label>
                <select class="form-control" id="select">
                    <option>All</option>
                    <option>Shampoo</option>
                    <option>Conditioner</option>
                    <option>Styling Aid</option>
                    <option>Mousse</option>
                    <option>Hairspray</option>
                    <option>Nail Polish</option>
                    <option>Gift Bag</option>
                </select>
            </div>
            <div class="form-group">
                <label for="select" class="control-label">Wholesale Cost</label>
                <select class="form-control" id="select">
                    <option>All</option>
                    <option>$0 - $9.99</option>
                    <option>$10-$14.99</option>
                    <option>$15-$19.99</option>
                    <option>$20-24.99</option>
                    <option>$25-$29.99</option>
                    <option>$30+</option>
                </select>
            </div>
            <div class="form-group">
                <label for="select" class="control-label">Retail Price</label>
                <select class="form-control" id="select">
                    <option>All</option>
                    <option>$0 - $9.99</option>
                    <option>$10-$14.99</option>
                    <option>$15-$19.99</option>
                    <option>$20-24.99</option>
                    <option>$25-$29.99</option>
                    <option>$30-$39.99</option>
                    <option>$40-$49.99</option>
                    <option>$50-$59.99</option>
                    <option>$60+</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="search-inventory">Search inventory</label>
                <input class="form-control" id="search-inventory" type="text" value="Search">
            </div>
        </fieldset>
    </form>

    <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Vendor</th>
            <th>Size</th>
            <th>Wholesale Cost</th>
            <th>Retail Price</th>
            <th>Quantity</th>
            <th>UPC</th>
        </tr>
    </thead>
    <tbody>
        <?php
$path = '../../../model/inventory.php';
if (file_exists($path)) {
    require($path);
    echo '<script>console.log("query is found");</script>';
} else {
        echo '<script>console.log("query is not found");</script>';
}
        ?>
    </tbody>
</table>

<script>
    $("#icon-toggler").click(function () {
        $(this).find('img').toggle();
    });
</script>