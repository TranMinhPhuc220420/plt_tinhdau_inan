<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssentialOilProduct extends Model
{
    use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'FkEssentialOilCategory_id',
    'EssentialOilProduct_Name',
    'EssentialOilProduct_Vote',
    'EssentialOilProduct_Sapo',
    'EssentialOilProduct_Description',
    'EssentialOilProduct_Info',
    'EssentialOilProduct_Price',
    'EssentialOilProduct_Discount',
    'EssentialOilProduct_ListImage',
  ];

  protected $guarded = [];

  public function toArray()
  {
    return [
      'id' => $this->id,
      'FkEssentialOilCategory_id' => $this->FkEssentialOilCategory_id,
      'EssentialOilProduct_Name' => $this->EssentialOilProduct_Name,
      'EssentialOilProduct_Vote' => $this->EssentialOilProduct_Vote,
      'EssentialOilProduct_Sapo' => $this->EssentialOilProduct_Sapo,
      'EssentialOilProduct_Description' => $this->EssentialOilProduct_Description,
      'EssentialOilProduct_Info' => $this->EssentialOilProduct_Info,
      'EssentialOilProduct_Price' => $this->EssentialOilProduct_Price,
      'EssentialOilProduct_Discount' => $this->EssentialOilProduct_Discount,
      'EssentialOilProduct_ListImage' => $this->EssentialOilProduct_ListImage,
      'PrintType_CreatedAt' => $this->created_at,
      'PrintType_UpdateAt' => $this->updated_at,
    ];
  }

  public function orders(){
    return $this->hasMany(OrderEssentialOil_EssentialOilProduct::class);
  }
}
