<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintType extends Model
{
    use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'PrintType_Name',
    'PrintType_Image',
  ];

  protected $guarded = [];

  public function toArray()
  {
    return [
      'id' => $this->id,
      'PrintType_Name' => $this->PrintType_Name,
      'PrintType_Image' => $this->PrintType_Image,
      'PrintType_CreatedAt' => $this->created_at,
      'PrintType_UpdateAt' => $this->updated_at,
    ];
  }

  public function printCategory(){
    return $this->hasMany(PrintCategory::class, 'FkPrintType_id');
  }
}
