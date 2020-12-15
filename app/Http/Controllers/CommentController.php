<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
  public function store(Request $request)
  {
    $fullName = $request->get('fullName');
    $email = $request->get('email');
    $contentComment = $request->get('contentComment');
    $idProductComment = $request->get('fuckingWowShit');
    $dateCreate = date('Y-m-d h:i:s');
    $isCommentForPrintStore = $request->get('isCommentForPrintStore');

    DB::table('comments')
      ->insert([
        'id' => time(),
        'Comment_Username' => $fullName,
        'Comment_Email' => $email,
        'Comment_Content' => $contentComment,
        'FkEssentialOilProduct_id' => !$isCommentForPrintStore ? $idProductComment : 2005,
        'FkPrintProduct_id'  => $isCommentForPrintStore ? $idProductComment : 2005,
        'created_at' => $dateCreate,
        'updated_at' => $dateCreate,
      ]);

    echo json_encode([
      'status' => 200,
      'message' => 'ok'
    ]);
  }
}
