<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportData extends BaseModel
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'import_datas';
}
