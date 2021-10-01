<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbOrderAllBrand extends Model
{
    // 保存したいカラム名の定義（複数の場合）
    protected $fillable = ['brand_id', 'year', 'quarter', 'month', 'week', 'day', 'day_of_week', 'date', 'men', 'women', 'total_tax', 'everage', 'total_product', 'total_product_tax', 'total_product_last_year', 'brand_coefficient', 'coefficient', 'sale_forecast', 'sale_forecast_cumulative', 'sale_forecast_last_year', 'sale_cumulative', 'sale_cumulative_last_year', 'sale_budget', 'sale_budget_cumulative', 'sale_budget_last_year', 'sale_budget_cumulative_last_year', 'coupon', 'number_item', 'session', 'cv', 'cvr', 'aov', 'number_new_customer', 'category_sale', 'proper_sale', 'total_sale', 'total_global', 'stock_sale', 'stock_global', 'type', 'created_at'];
    public $timestamps = false;  //created_at,updated_at は使わない
}
