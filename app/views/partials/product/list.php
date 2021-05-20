<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-sm-3 ">
                    <div class="card mb-2">
                        <div class="card-header h4 h4"></div>
                        <div class="p-2">
                            <?php 
                            $to = 10;
                            $from = 0;
                            if(!empty($_GET['product_product_sel_price'])){
                            $range = explode('-', get_value('product_product_sel_price'));
                            $from = $range[0];
                            $to = (!empty($range[1]) ? $range[1] : null);
                            }
                            ?>
                            <input class="ion-range" type="text" data-from="<?php echo $from ?>" data-to="<?php echo $to ?>" data-force_edge="true" data-prefix="" data-postfix=""  name="product_product_sel_price" data-step="10" data-type="double" data-min="0"   data-max="100"     /> 
                            </div>
                        </div>
                        <h4 class="record-title">Product</h4>
                    </div>
                    <div class="col-sm-3 ">
                        <a  class="btn btn btn-primary my-1" href="<?php print_link("product/add") ?>">
                            <i class="fa fa-plus"></i>                              
                            Add New Product 
                        </a>
                    </div>
                    <div class="col-sm-3 ">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                            <form  class="search" action="<?php print_link('product'); ?>" method="get">
                                <div class="input-group">
                                    <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="text-left">
                                    <h4></h4>
                                    <p class="text-muted"></p>
                                </div>
                                <div class="smartwizard" data-theme="dots" data-form-action="">
                                    <ul>
                                        <li>
                                            <a href="#FormWizard-2-Page1">
                                                Step 1
                                                <br /><small></small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#FormWizard-2-Page2">
                                                Step 2
                                                <br /><small></small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#FormWizard-2-Page3">
                                                Step 3
                                                <br /><small></small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#FormWizard-2-Page4">
                                                Step 4
                                                <br /><small></small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#FormWizard-2-Page5">
                                                Step 5
                                                <br /><small></small>
                                            </a>
                                        </li>
                                    </ul>
                                    <div>
                                        <div class="card formtab" id="FormWizard-2-Page1" data-next-page="FormWizard-2-Page2" data-submit-action="MOVE-NEXT">
                                            <div class="">
                                                <div class="text-center">
                                                    <div class="p-3">
                                                        <h4>Welcome To Form Wizard</h4>
                                                        <hr />
                                                        <p class="text-muted">You can drag and drop <b>Add Sub Page</b> onto the form wizard steps</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center p-3">
                                                <button class="btn btn-success sw-btn-next">Getting Started</button>
                                            </div>
                                        </div>
                                        <div class="card formtab" id="FormWizard-2-Page2" data-next-page="FormWizard-2-Page3" data-submit-action="SUBMIT-STEP-FORM">
                                            <div class=" p-3">
                                            </div>
                                        </div>
                                        <div class="card formtab" id="FormWizard-2-Page3" data-next-page="FormWizard-2-Page4" data-submit-action="SUBMIT-STEP-FORM">
                                            <div class=" p-3">
                                            </div>
                                        </div>
                                        <div class="card formtab" id="FormWizard-2-Page4" data-next-page="FormWizard-2-Page5" data-submit-action="SUBMIT-ALL-FORMS">
                                            <div class=" p-3">
                                            </div>
                                        </div>
                                        <div class="card formtab" id="FormWizard-2-Page5" data-next-page="FormWizard-2-Page6" data-submit-action="">
                                            <div class="">
                                                <div class="text-center">
                                                    <h4>Form Wizard Completed</h4>
                                                    <hr />
                                                    <p class="text-muted">Thank you for your support</p>
                                                </div>
                                            </div>
                                            <div class=" p-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $menu_id = "menu-" . random_str(); ?>
                                <div class="card mb-3 ">
                                    <nav class="navbar navbar-expand-lg navbar-light">
                                        <span class="navbar-brand mb-0 h4"></span>
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                    </nav>  
                                    <div class="collapse collapse-lg " id="<?php echo $menu_id ?>">
                                        <?php 
                                        $arr_menu = array();
                                        $menus = $comp_model->productid_list(); // Get menu items from database
                                        if(!empty($menus)){
                                        //build menu items into arrays
                                        foreach($menus as $menu){
                                        $arr_menu[] = array(
                                        "path"=>"product/list/product.id/$menu[id]?label=$menu[product_number]&tag=Product Product Number", 
                                        "label"=>"$menu[product_number] <span class='badge badge-primary float-right'>$menu[num]</span>", 
                                        "icon"=>''
                                        );
                                        }
                                        //call menu render helper.
                                        Html :: render_menu($arr_menu , "nav nav-tabs flex-column");
                                        }
                                        ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group text-center">
                                    <button class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            <div  class="">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12 comp-grid">
                            <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                                <div class="card mb-3">
                                    <div class="card-header h4 h4">Filter by Product Product Stock Lavel</div>
                                    <div class="p-2">
                                        <?php 
                                        $product_product_stock_lavel_options = $comp_model -> product_productproduct_stock_lavel_option_list();
                                        if(!empty($product_product_stock_lavel_options)){
                                        foreach($product_product_stock_lavel_options as $option){
                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                        $checked = $this->set_field_checked('product_product_stock_lavel', $value);
                                        ?>
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input id="" class="custom-control-input" <?php echo $checked; ?> value="<?php echo $value; ?>" type="radio"  name="product_product_stock_lavel"  />
                                                <span class="custom-control-label"><?php echo $label; ?></span>
                                            </label>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-header h4 h4">Filter by Product Product Stock Lavel</div>
                                        <div class="p-2">
                                            <?php 
                                            $product_product_stock_lavel_options = $comp_model -> product_productproduct_stock_lavel_option_list_2();
                                            if(!empty($product_product_stock_lavel_options)){
                                            $ci = 0;
                                            foreach($product_product_stock_lavel_options as $option){
                                            $ci++;
                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                            $checked = $this->set_field_checked('product_product_stock_lavel', $value);
                                            ?>
                                            <label class="custom-control custom-checkbox custom-control-inline">
                                                <input id="" class="custom-control-input" <?php echo $checked; ?> value="<?php echo $value; ?>" type="checkbox" name="product_product_stock_lavel[]"  />
                                                    <span class="custom-control-label"><?php echo $label; ?></span>
                                                </label>
                                                <?php
                                                }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Drop Down
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <?php 
                                                $option_list = $comp_model->product_productproduct_buy_price_option_list();
                                                if(!empty($option_list)){
                                                foreach($option_list as $option){
                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                $nav_link = $this->set_current_page_link(array('product_product_buy_price' => $value , 'product_product_buy_pricelabel' => $label) , true);
                                                ?>
                                                <a class="dropdown-item <?php echo is_active_link('product_product_buy_price', $value); ?>" href="<?php print_link($nav_link) ?>">
                                                    <?php echo $label; ?>
                                                </a>
                                                <?php
                                                }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="card card-body">
                                            <?php 
                                            $chartdata = $comp_model->doughnutchart_newchart2();
                                            ?>
                                            <div>
                                                <h4>New Chart 2</h4>
                                                <small class="text-muted"></small>
                                            </div>
                                            <hr />
                                            <canvas id="doughnutchart_newchart2"></canvas>
                                            <script>
                                                $(function (){
                                                var chartData = {
                                                labels : <?php echo json_encode($chartdata['labels']); ?>,
                                                datasets : [
                                                {
                                                label: 'Dataset 1',
                                                backgroundColor:'<?php echo random_color(0.9); ?>',
                                                borderWidth:3,
                                                data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                                                }
                                                ]
                                                }
                                                var ctx = document.getElementById('doughnutchart_newchart2');
                                                var chart = new Chart(ctx, {
                                                type:'doughnut',
                                                data: chartData,
                                                options: {
                                                responsive: true,
                                                scales: {
                                                yAxes: [{
                                                ticks:{display: false},
                                                gridLines:{display: false},
                                                scaleLabel: {
                                                display: true,
                                                labelString: ""
                                                }
                                                }],
                                                xAxes: [{
                                                ticks:{display: false},
                                                gridLines:{display: false},
                                                scaleLabel: {
                                                display: true,
                                                labelString: ""
                                                }
                                                }],
                                                },
                                                }
                                                ,
                                                })});
                                            </script>
                                        </div>
                                        <div class="card card-body">
                                            <?php 
                                            $chartdata = $comp_model->piechart_newchart1();
                                            ?>
                                            <div>
                                                <h4>New Chart 1</h4>
                                                <small class="text-muted"></small>
                                            </div>
                                            <hr />
                                            <canvas id="piechart_newchart1"></canvas>
                                            <script>
                                                $(function (){
                                                var chartData = {
                                                labels : <?php echo json_encode($chartdata['labels']); ?>,
                                                datasets : [
                                                {
                                                label: 'Dataset 1',
                                                backgroundColor:'<?php echo random_color(0.9); ?>',
                                                borderWidth:3,
                                                data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                                                }
                                                ]
                                                }
                                                var ctx = document.getElementById('piechart_newchart1');
                                                var chart = new Chart(ctx, {
                                                type:'pie',
                                                data: chartData,
                                                options: {
                                                responsive: true,
                                                scales: {
                                                yAxes: [{
                                                ticks:{display: false},
                                                gridLines:{display: false},
                                                scaleLabel: {
                                                display: true,
                                                labelString: ""
                                                }
                                                }],
                                                xAxes: [{
                                                ticks:{display: false},
                                                gridLines:{display: false},
                                                scaleLabel: {
                                                display: true,
                                                labelString: ""
                                                }
                                                }],
                                                },
                                                }
                                                ,
                                                })});
                                            </script>
                                        </div>
                                        <?php $this :: display_page_errors(); ?>
                                        <div class="filter-tags mb-2">
                                            <?php
                                            if(!empty(get_value('product_product_sel_price'))){
                                            ?>
                                            <div class="filter-chip card bg-light">
                                                <b>Sel Price :</b> 
                                                <?php 
                                                if(get_value('product_product_sel_pricelabel')){
                                                echo get_value('product_product_sel_pricelabel');
                                                }
                                                else{
                                                echo get_value('product_product_sel_price');
                                                }
                                                $remove_link = unset_get_value('product_product_sel_price', $this->route->page_url);
                                                ?>
                                                <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                                    &times;
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if(!empty(get_value('product_product_stock_lavel'))){
                                            ?>
                                            <div class="filter-chip card bg-light">
                                                <b>Product Product Stock Lavel :</b> 
                                                <?php 
                                                if(get_value('product_product_stock_lavellabel')){
                                                echo get_value('product_product_stock_lavellabel');
                                                }
                                                else{
                                                echo get_value('product_product_stock_lavel');
                                                }
                                                $remove_link = unset_get_value('product_product_stock_lavel', $this->route->page_url);
                                                ?>
                                                <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                                    &times;
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if(!empty(get_value('product_product_buy_price'))){
                                            ?>
                                            <div class="filter-chip card bg-light">
                                                <b>Product Product Buy Price :</b> 
                                                <?php 
                                                if(get_value('product_product_buy_pricelabel')){
                                                echo get_value('product_product_buy_pricelabel');
                                                }
                                                else{
                                                echo get_value('product_product_buy_price');
                                                }
                                                $remove_link = unset_get_value('product_product_buy_price', $this->route->page_url);
                                                ?>
                                                <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                                    &times;
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div  class=" animated fadeIn page-content">
                                            <div id="product-list-records">
                                                <div id="page-report-body" class="table-responsive">
                                                    <table class="table  table-striped table-sm text-left">
                                                        <thead class="table-header bg-light">
                                                            <tr>
                                                                <th class="td-checkbox">
                                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                                        <span class="custom-control-label"></span>
                                                                    </label>
                                                                </th>
                                                                <th class="td-sno">#</th>
                                                                <th  class="td-product_number"> Product Number</th>
                                                                <th  class="td-product_name"> Product Name</th>
                                                                <th  class="td-product_desc"> Product Desc</th>
                                                                <th  <?php echo (get_value('orderby')=='product_stock_lavel' ? 'class="sortedby td-product_stock_lavel"' : null); ?>>
                                                                    <?php Html :: get_field_order_link('product_stock_lavel', "Product Stock Lavel"); ?>
                                                                </th>
                                                                <th  class="td-product_buy_price"> Product Buy Price</th>
                                                                <th  <?php echo (get_value('orderby')=='product_sel_price' ? 'class="sortedby td-product_sel_price"' : null); ?>>
                                                                    <?php Html :: get_field_order_link('product_sel_price', "Product Sel Price"); ?>
                                                                </th>
                                                                <th class="td-btn"></th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        if(!empty($records)){
                                                        ?>
                                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                            <!--record-->
                                                            <?php
                                                            $counter = 0;
                                                            foreach($records as $data){
                                                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                                            $counter++;
                                                            ?>
                                                            <tr>
                                                                <th class=" td-checkbox">
                                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                                            <span class="custom-control-label"></span>
                                                                        </label>
                                                                    </th>
                                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                                    <td class="td-product_number"> <span><svg id="barcode<?php echo $counter; ?>"></svg></span>
                                                                        <script>
                                                                            JsBarcode("#barcode<?php echo $counter; ?>", "<?php echo $data['product_number'].$counter; ?>", {
                                                                            format: "CODE128",
                                                                            //   lineColor: "#0aa",
                                                                            width: 3,
                                                                            height: 15,
                                                                            displayValue: true
                                                                            });
                                                                        </script></td>
                                                                        <td class="td-product_name">
                                                                            <span  data-value="<?php echo $data['product_name']; ?>" 
                                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                                data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                                                data-name="product_name" 
                                                                                data-title="Enter Product Name" 
                                                                                data-placement="left" 
                                                                                data-toggle="click" 
                                                                                data-type="text" 
                                                                                data-mode="popover" 
                                                                                data-showbuttons="left" 
                                                                                class="is-editable" >
                                                                                <?php echo $data['product_name']; ?> 
                                                                            </span>
                                                                        </td>
                                                                        <td class="td-product_desc">
                                                                            <span  data-pk="<?php echo $data['id'] ?>" 
                                                                                data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                                                data-name="product_desc" 
                                                                                data-title="Enter Product Desc" 
                                                                                data-placement="left" 
                                                                                data-toggle="click" 
                                                                                data-type="textarea" 
                                                                                data-mode="popover" 
                                                                                data-showbuttons="left" 
                                                                                class="is-editable" >
                                                                                <?php echo $data['product_desc']; ?> 
                                                                            </span>
                                                                        </td>
                                                                        <td class="td-product_stock_lavel">
                                                                            <span  data-value="<?php echo $data['product_stock_lavel']; ?>" 
                                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                                data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                                                data-name="product_stock_lavel" 
                                                                                data-title="Enter Product Stock Lavel" 
                                                                                data-placement="left" 
                                                                                data-toggle="click" 
                                                                                data-type="number" 
                                                                                data-mode="popover" 
                                                                                data-showbuttons="left" 
                                                                                class="is-editable" >
                                                                                <?php echo $data['product_stock_lavel']; ?> 
                                                                            </span>
                                                                        </td>
                                                                        <td class="td-product_buy_price">
                                                                            <span  data-step="0.1" 
                                                                                data-value="<?php echo $data['product_buy_price']; ?>" 
                                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                                data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                                                data-name="product_buy_price" 
                                                                                data-title="Enter Product Buy Price" 
                                                                                data-placement="left" 
                                                                                data-toggle="click" 
                                                                                data-type="number" 
                                                                                data-mode="popover" 
                                                                                data-showbuttons="left" 
                                                                                class="is-editable" >
                                                                                <?php echo $data['product_buy_price']; ?> 
                                                                            </span>
                                                                        </td>
                                                                        <td class="td-product_sel_price">
                                                                            <span  data-step="0.1" 
                                                                                data-value="<?php echo $data['product_sel_price']; ?>" 
                                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                                data-url="<?php print_link("product/editfield/" . urlencode($data['id'])); ?>" 
                                                                                data-name="product_sel_price" 
                                                                                data-title="Enter Product Sel Price" 
                                                                                data-placement="left" 
                                                                                data-toggle="click" 
                                                                                data-type="number" 
                                                                                data-mode="popover" 
                                                                                data-showbuttons="left" 
                                                                                class="is-editable" >
                                                                                <?php echo $data['product_sel_price']; ?> 
                                                                            </span>
                                                                        </td>
                                                                        <th class="td-btn">
                                                                            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("product/view/$rec_id"); ?>">
                                                                                <i class="fa fa-eye"></i> View
                                                                            </a>
                                                                            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("product/edit/$rec_id"); ?>">
                                                                                <i class="fa fa-edit"></i> Edit
                                                                            </a>
                                                                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("product/delete/$rec_id/?csrf_token=$csrf_token"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                                                <i class="fa fa-times"></i>
                                                                                Delete
                                                                            </a>
                                                                        </th>
                                                                    </tr>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                    <!--endrecord-->
                                                                </tbody>
                                                                <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                                                <?php
                                                                }
                                                                ?>
                                                            </table>
                                                            <?php 
                                                            if(empty($records)){
                                                            ?>
                                                            <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                                                <i class="fa fa-ban"></i> No record found
                                                            </h4>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <?php
                                                        if( $show_footer && !empty($records)){
                                                        ?>
                                                        <div class=" border-top mt-2">
                                                            <div class="row justify-content-center">    
                                                                <div class="col-md-auto justify-content-center">    
                                                                    <div class="p-3 d-flex justify-content-between">    
                                                                        <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("product/delete/{sel_ids}/?csrf_token=$csrf_token"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                                            <i class="fa fa-times"></i> Delete Selected
                                                                        </button>
                                                                        <div class="dropup export-btn-holder mx-1">
                                                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="fa fa-save"></i> Export
                                                                            </button>
                                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                                                <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                                    <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                                    </a>
                                                                                    <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                                    <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                                        <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                                        </a>
                                                                                        <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                                        <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                                            <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                                            </a>
                                                                                            <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                                            <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                                                <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                                                </a>
                                                                                                <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                                                <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                                    <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col">   
                                                                                        <?php
                                                                                        if($show_pagination == true){
                                                                                        $pager = new Pagination($total_records, $record_count);
                                                                                        $pager->route = $this->route;
                                                                                        $pager->show_page_count = true;
                                                                                        $pager->show_record_count = true;
                                                                                        $pager->show_page_limit =true;
                                                                                        $pager->limit_count = $this->limit_count;
                                                                                        $pager->show_page_number_list = true;
                                                                                        $pager->pager_link_range=5;
                                                                                        $pager->render();
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <hr />
                                                                    <div class="form-group text-center">
                                                                        <button class="btn btn-primary">Filter</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-6 comp-grid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div  class="">
                                                    <div class="container">
                                                        <div class="row ">
                                                            <div class="col-md-12 comp-grid">
                                                                <div class=" ">
                                                                    <?php  
                                                                    $this->render_page("product/view/$page_id"); 
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
