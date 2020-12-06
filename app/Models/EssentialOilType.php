<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssentialOilType extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'EssentialOilType_Name',
    ];

    protected $guarded = [];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'EssentialOilType_Name' => $this->EssentialOilType_Name,
            'EssentialOilType_CreatedaAt' => $this->created_at,
            'EssentialOilType_UpdateAt' => $this->updated_at
        ];
    }

    public function essentialOilCategory(){
        return $this->hasMany(EssentialOilCategory::class, 'essential_oil_types_id');
    }
}
