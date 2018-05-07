<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use zgldh\QiniuStorage\QiniuStorage;

class CommonController extends Controller
{

    public function uploadCover_api(Request $request)
    {
        $file = $request->file('cover');

        // 使用七牛云上传
        $disk = QiniuStorage::disk('qiniu');

        // 上传
        $upload = $disk->put('cover', $file);

        if (!$upload) {
            return response()->json([
                'status' => 404,
                'msg' => 'fail to upload cover',
            ]);
        }
        // 获取下载链接
        $cover_url = $disk->downloadUrl($upload);
        Log::info($cover_url);
        return response()->json([
            'status' => 200,
            'data' => $cover_url,
            'msg' => 'success to upload cover'
        ]);
    }

    public function uploadImage_api(Request $request)
    {
        $file = $request->file('file');
        // 使用七牛云上传
        $disk = QiniuStorage::disk('qiniu');
        // 上传
        $upload = $disk->put('image', $file);

        if (!$upload) {
            return response()->json([
                'status' => 404,
                'msg' => 'fail to upload image',
            ]);
        }
        // 获取下载链接
        $image_url = $disk->downloadUrl($upload);
        Log::info($image_url);
        return response()->json([
            'status' => 200,
            'data' => $image_url,
            'msg' => 'success to upload cover'
        ]);
    }
}