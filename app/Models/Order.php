<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'Order_FullNameUser',
    'Order_NumberPhoneUser',
    'Order_EmailUser',
    'Order_AddressUserSend',
    'Order_ListProductID',
    'Order_Note',
  ];

  public function toArray()
  {
    return [
      'id' => $this->id,
      'Order_FullNameUser' => $this->Order_FullNameUser,
      'Order_NumberPhoneUser' => $this->Order_NumberPhoneUser,
      'Order_EmailUser' => $this->Order_EmailUser,
      'Order_AddressUserSend' => $this->Order_AddressUserSend,
      'Order_ListProductID' => $this->Order_ListProductID,
      'Order_Note' => $this->Order_Note,
    ];
  }
}
