<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintProduct extends Model
{
    use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'PrintProduct_Name',
    'PrintProduct_ListImage',
    'PrintProduct_ListPrice',
    'FkPrintCategory_id',
    'PrintProduct_Sapo',
    'PrintProduct_Vote',
    'PrintProduct_Description',
    'PrintProduct_Info',
  ];

  protected $guarded = [];

  public function toArray()
  {
    return [
      'id' => $this->id,
      'PrintProduct_Name' => $this->PrintProduct_Name,
      'PrintProduct_ListImage' => $this->PrintProduct_ListImage,
      'PrintProduct_ListPrice' => $this->PrintProduct_ListPrice,
      'FkPrintCategory_id' => $this->FkPrintCategory_id,
      'PrintProduct_Sapo' => $this->PrintProduct_Sapo,
      'PrintProduct_Vote' => $this->PrintProduct_Vote,
      'PrintProduct_Description' => $this->PrintProduct_Description,
      'PrintProduct_Info' => $this->PrintProduct_Info,
      'PrintType_CreatedAt' => $this->created_at,
      'PrintType_UpdateAt' => $this->updated_at,
    ];
  }
}
