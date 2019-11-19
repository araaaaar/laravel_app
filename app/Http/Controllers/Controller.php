<?php

// 関数名クラス名の名前の衝突を避けたり、別のファイルから関数などを呼び出しやすくする為、名前空間を定義
// namespaceより前に記述するとエラーが起こる為、最初に記述、declare文のみok
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
