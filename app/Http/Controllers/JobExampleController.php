<?php

namespace App\Http\Controllers;

use App\Http\Components\FileOperation;
use App\Jobs\GenerateTextFile;
use Illuminate\Http\Request;

class JobExampleController extends Controller
{
    const MAX = 3000; // ループ回数

    private $fp;

    public function __construct(FileOperation $fileOperation)
    {
        $this->fp = $fileOperation;
    }

//    /**
//     * 同期処理
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
//     */
//    public function queuesNone()
//    {
//        $start = time();
//
//        $file = $this->fp->makeTextFile();
//
//        $this->fp->write($file, self::MAX);
//
//        return view('sample_queues', ['start' => $start]);
//    }
    /**
     * 非同期処理
     * jobをキューテーブルに登録、非同期で処理、とりあえずレスポンス、処理終わったらDBから削除
     * TODO::キューの処理中にエラーが起きたらどうなる？どうするべき？
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function queuesDatabase()
    {
        $start = time();

        $file = $this->fp->makeTextFile();

        GenerateTextFile::dispatch($file, self::MAX);

        var_dump($start,$file);

        return view('welcome');
    }
}
