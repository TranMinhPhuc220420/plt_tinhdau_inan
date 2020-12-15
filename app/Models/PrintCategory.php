<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintCategory extends Model
{
    use HasFactory;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'PrintCategory_Name',
    'PrintCategory_Image',
    'FkPrintType_id',
  ];

  protected $guarded = [];

  public function toArray()
  {
    return [
      'id' => $this->id,
      'PrintCategory_Name' => $this->PrintCategory_Name,
      'PrintCategory_Image' => $this->PrintCategory_Image,
      'FkPrintType_id' => $this->FkPrintType_id,
      'PrintCategory_CreatedAt' => $this->created_at,
      'PrintCategory_UpdateAt' => $this->updated_at,
    ];
  }

  public function printType() {
    return $this->belongsTo(PrintType::class, 'FkPrintType_id');
  }
}
