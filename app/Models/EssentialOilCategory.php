<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssentialOilCategory extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'EssentialOilCategory_Name',
        'FkEssentialOilType_id',
    ];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'EssentialOilCategory_Name' => $this->EssentialOilCategory_Name,
            'essential_oil_types_id' => $this->essential_oil_types_id,
            'EssentialOilCategory_CreatedaAt' => $this->created_at,
            'EssentialOilCategory_UpdateAt' => $this->updated_at
        ];
    }

    public function essentialOilType() {
        return $this->belongsTo(EssentialOilType::class, 'essential_oil_types_id');
    }
}
