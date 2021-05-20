<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * productid_list Model Action
     * @return array
     */
	function productid_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT id , product_number ,   COUNT(*) AS num FROM product GROUP BY id";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * product_productproduct_stock_lavel_option_list Model Action
     * @return array
     */
	function product_productproduct_stock_lavel_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT product_sel_price AS value,product_buy_price AS label FROM product";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * product_productproduct_stock_lavel_option_list_2 Model Action
     * @return array
     */
	function product_productproduct_stock_lavel_option_list_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT product_sel_price AS value,product_sel_price AS label FROM product";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * product_productproduct_buy_price_option_list Model Action
     * @return array
     */
	function product_productproduct_buy_price_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT product_buy_price AS value,product_name AS label FROM product";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
	* doughnutchart_newchart2 Model Action
	* @return array
	*/
	function doughnutchart_newchart2(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT  p.id, p.product_number, p.product_name, p.product_desc, p.product_stock_lavel, p.product_buy_price, p.product_sel_price, p.date FROM product AS p WHERE  (p.product_stock_lavel  <10 )";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'id');
		$dataset_labels =  array_column($dataset1, 'product_number');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* piechart_newchart1 Model Action
	* @return array
	*/
	function piechart_newchart1(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT  p.id, p.product_number, p.product_name, p.product_desc, p.product_stock_lavel, p.product_buy_price, p.product_sel_price, p.date FROM product AS p";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'id');
		$dataset_labels =  array_column($dataset1, 'product_number');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

}
