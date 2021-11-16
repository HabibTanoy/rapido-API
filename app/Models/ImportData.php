<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportData extends BaseModel
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['order_number'];
    protected $table = 'import_datas';

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }
    public function getOrderNumberAttribute($order)
    {
       $types = $this->delivery_types;
        if ($types == "Regular") {
            $order_id = 'RPDR-' . $this->id;
            $order_number = $order_id;
        }
        elseif ($types == "Express") {
            $order_id = 'RPDE-' . $this->id;
            $order_number = $order_id;
        }
        elseif ($types == "Next Day") {
            $order_id = 'RPDN-' . $this->id;
            $order_number = $order_id;
        }
        return "$order_number";
    }
}
