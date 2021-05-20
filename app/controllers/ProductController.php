<?php 
/**
 * Product Page Controller
 * @category  Controller
 */
class ProductController extends BaseController{
	function __construct(){
		parent::__construct();
		$this->tablename = "product";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"product_number", 
			"product_name", 
			"product_desc", 
			"product_stock_lavel", 
			"product_buy_price", 
			"product_sel_price");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				product.id LIKE ? OR 
				product.product_number LIKE ? OR 
				product.product_name LIKE ? OR 
				product.product_desc LIKE ? OR 
				product.product_stock_lavel LIKE ? OR 
				product.product_buy_price LIKE ? OR 
				product.product_sel_price LIKE ? OR 
				product.date LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "product/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("product.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->product_product_sel_price)){
			$vals = explode("-", str_replace(" ", "", $request->product_product_sel_price));
			$from = $vals[0];
			$to = $vals[1];
			$db->where("product.product_sel_price BETWEEN $from AND $to");
		}
		if(!empty($request->product_product_stock_lavel)){
			$val = $request->product_product_stock_lavel;
			$db->where("product.product_stock_lavel", $val , "=");
		}
		if(!empty($request->product_product_buy_price)){
			$val = $request->product_product_buy_price;
			$db->where("product.product_buy_price", $val , "=");
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Product";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("product/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"product_number", 
			"product_name", 
			"product_desc", 
			"product_stock_lavel", 
			"product_buy_price", 
			"product_sel_price");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("product.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Product";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("product/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("product_number","product_name","product_desc","product_stock_lavel","product_buy_price","product_sel_price");
			$postdata = $this->format_request_data($formdata);
			$this->validate_captcha = true; //will check for captcha validation
			$this->rules_array = array(
				'product_name' => 'required',
				'product_desc' => 'required',
				'product_stock_lavel' => 'required|numeric',
				'product_buy_price' => 'required|numeric',
				'product_sel_price' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'product_name' => 'sanitize_string',
				'product_desc' => 'sanitize_string',
				'product_stock_lavel' => 'sanitize_string',
				'product_buy_price' => 'sanitize_string',
				'product_sel_price' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['product_number'] = 'BBC'.time();
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("product");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Product";
		$this->render_view("product/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","product_number","product_name","product_desc","product_stock_lavel","product_buy_price","product_sel_price");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'product_name' => 'required',
				'product_desc' => 'required',
				'product_stock_lavel' => 'required|numeric',
				'product_buy_price' => 'required|numeric',
				'product_sel_price' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'product_name' => 'sanitize_string',
				'product_desc' => 'sanitize_string',
				'product_stock_lavel' => 'sanitize_string',
				'product_buy_price' => 'sanitize_string',
				'product_sel_price' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['product_number'] = 'BBC'.time();
			if($this->validated()){
				$db->where("product.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("product");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("product");
					}
				}
			}
		}
		$db->where("product.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Product";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("product/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id","product_number","product_name","product_desc","product_stock_lavel","product_buy_price","product_sel_price");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'product_name' => 'required',
				'product_desc' => 'required',
				'product_stock_lavel' => 'required|numeric',
				'product_buy_price' => 'required|numeric',
				'product_sel_price' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'product_name' => 'sanitize_string',
				'product_desc' => 'sanitize_string',
				'product_stock_lavel' => 'sanitize_string',
				'product_buy_price' => 'sanitize_string',
				'product_sel_price' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("product.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("product.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("product");
	}
}
