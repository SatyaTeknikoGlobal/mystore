<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Product;
use App\Category;
use App\Helpers\CustomHelper;

use DB;

class ProductImport implements ToCollection, WithHeadingRow {

    public function collection(Collection $rows){

    	//prd($rows);

    	if(!empty($rows) && $rows->count() > 0){

    		$productModel = new Product;

    		//prd($productModel->getFillable());

    		$fieldArr = $productModel->getFillable();

    		//pr($fieldArr);

    		$total = $rows->count();

    		$inserted = 0;
    		$updated = 0;

    		foreach ($rows as $row) {
    			//pr($row->toArray());

    			$id = $row['id'];
                $product_name = $row['name'];

    			$category_id = $row['category_id'];
    				
    			$product = new Product;

                $isExist = false;

    			if(is_numeric($id) && $id > 0){

    				$exist = Product::find($id);

    				if(isset($exist->id) && $exist->id == $id){
    					$product = $exist;
                        $isExist = true;
    				}

    			}

                $slug = '';

                if($isExist){
                    $slug = CustomHelper::GetSlug('products', 'id', $id, $product_name);
                }
                else{
                    $slug = CustomHelper::GetSlug('products', 'id', '', $product_name);
                }

    			foreach($fieldArr as $field){
    				if(isset($row[$field])){
    					$product->$field = $row[$field];
    				}
    			}

                $product->slug = $slug;

    			$isSaved = $product->save();

    			$product_id = 0;

    			if($isSaved){
    				$product_id = $product->id;

    				if(is_numeric($id) && $id > 0){
    					$updated++;
    				}
    				else{
    					$inserted++;
    				}

    				$scc_msg = '<div class="alert alert-success"><a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>';

                    $scc_msg .= '<strong>Products upload summary : </strong><br>';
                    $scc_msg .= 'Total Records : '.$total.'<br>';
                    $scc_msg .= 'New Inserted Record(s) : '.$inserted.'<br>';
                    $scc_msg .= 'Updated Record(s) : '.$updated;

                    $scc_msg .= '</div>';

                    session()->flash('scc_msg', $scc_msg);
    			}

    			if(is_numeric($product_id) && $product_id > 0 && is_numeric($category_id) && $category_id > 0){    				

    				$category = Category::find($category_id);

    				if(!empty($category) && $category->count() > 0){

    					$subParentCategory = $category->parent;

    					$subParentCategoryId = (isset($subParentCategory->id))?$subParentCategory->id:0;
    					$parentCategory = (isset($subParentCategory->parent))?$subParentCategory->parent:'';
    					$parentCategorId = (isset($parentCategory->id))?$parentCategory->id:0;

    					$categoryAttributes = (isset($parentCategory->categoryAttributes))?$parentCategory->categoryAttributes:'';

    					$this->saveCategories($parentCategorId, $subParentCategoryId, $category_id, $product_id);

    					$this->saveAttributes($categoryAttributes, $row, $product_id);

    				}
    			}

    			//prd($product->toArray());

    		}
    	}
    }

    private function saveCategories($p1_cat, $p2_cat, $category_id, $product_id){

        if(is_numeric($product_id) && $product_id > 0){

            $category_data = [];

            if(!empty($p1_cat) && !empty($p2_cat) && !empty($category_id)){

                DB::table('product_categories')->where('product_id', $product_id)->delete();

                $category_data['product_id'] = $product_id;
                $category_data['p1_cat'] = $p1_cat;
                $category_data['p2_cat'] = $p2_cat;
                $category_data['category_id'] = $category_id;

                DB::table('product_categories')->insert($category_data);

            } 
        }
    }

    private function saveAttributes($categoryAttributes, $row, $product_id){

    	$is_inserted = '';

    	if(!empty($categoryAttributes) && $categoryAttributes->count() > 0){    		

    		$attrData = [];

    		$attrCount = 1;

    		foreach($categoryAttributes as $ca){

    			$attrIndex = 'attribute_'.$attrCount;

    			if(isset($row[$attrIndex]) && !empty($row[$attrIndex])){
    				$attrData[] = array(
    					'product_id' => $id,
    					'label' => $ca->label,
    					'value' => $row[$attrIndex],
    				);
    			}

    			$attrCount++;
    		}

    		//pr($attrData);

    		if(!empty($attrData) && count($attrData) > 0){

    			DB::table('product_attributes')->where('product_id', $product_id)->delete();

    			$is_inserted = DB::table('product_attributes')->insert($attrData);
    		}
    	}

    	return $is_inserted;

    }

    /* end of class */
}