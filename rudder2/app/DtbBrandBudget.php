<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbBrandBudget extends Model
{
    // 保存したいカラム名の定義（複数の場合）
    protected $fillable = ['brand_id', 'year', 'month', 'rank', 'brand_budget_year', 'ruby_budget_year', 'brand_budget_month', 'ruby_budget_month'];
    public $timestamps = false;  //created_at,updated_at は使わない
}
