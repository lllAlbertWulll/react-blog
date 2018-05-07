<?php
namespace App\Repositories;

use App\Comment;

class CommentRepository
{
    public function createComment(array $attributes) {
        return Comment::create($attributes);
    }

    public function findCommentIndex()
    {
        return Comment::where('is_delete', 0)->get();
    }

    public function findCommentTrash()
    {
        return Comment::where('is_delete', 1)->get();
    }

    public function deleteById($id) {
        return Comment::where('id', $id)->orWhere('parent_id', $id)->update(['is_delete' => 1]);
    }

    public function recoveryById($id) {
        return Comment::where('id', $id)->orWhere('parent_id', $id)->update(['is_delete' => 0]);
    }

    public function destroyById($id) {
        return Comment::where('id', $id)->orWhere('parent_id', $id)->delete();
    }

    public function findCommentByIp($ip)
    {
        return Comment::where('ip', $ip)->orderBy('created_at', 'desc')->first();
    }

    public function getCity($ip = '')
    {
        if($ip == ''){
            $url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
            $ip=json_decode(file_get_contents($url),true);
            $data = $ip;
        }else{
            $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
            $ip=json_decode(file_get_contents($url));
            if((string)$ip->code=='1'){
                return false;
            }
            $data = (array)$ip->data;
        }

        return $data;
    }
}