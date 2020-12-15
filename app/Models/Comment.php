<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  use HasFactory;

  protected $guarded = [];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'Comment_Username',
    'Comment_Email',
    'Comment_Content',
  ];

  public function toArray()
  {
    return [
      'id' => $this->id,
      'Comment_Username' => $this->Comment_Username,
      'Comment_Email' => $this->Comment_Email,
      'Comment_Content' => $this->Comment_Content,
      'FkEssentialOilProduct_id' => $this->FkEssentialOilProduct_id,
      'FkPrintProduct_id' => $this->FkPrintProduct_id,
    ];
  }

  public function EssentialOilProduct() {
    return $this->belongsTo(EssentialOilProduct::class, 'FkEssentialOilType_id');
  }

  public function PrintProduct() {
    return $this->belongsTo(EssentialOilProduct::class, 'FkPrintProduct_id');
  }
}
