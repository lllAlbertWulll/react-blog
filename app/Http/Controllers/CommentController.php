<?php

namespace App\Http\Controllers;

use App\Repositories\AdminRepository;
use App\Repositories\HomeRepository;
use Auth;
use App\Http\Requests\StoreCommentPost;
use App\Repositories\CommentRepository;
use Identicon\Identicon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;
    protected $adminRepository;
    protected $homeRepository;
    protected $identicon;

    public function __construct(CommentRepository $commentRepository, HomeRepository $homeRepository, AdminRepository $adminRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->adminRepository = $adminRepository;
        $this->homeRepository = $homeRepository;
        $this->identicon = new Identicon();
    }

    public function index()
    {
        $comments = $this->commentRepository->findCommentIndex();
        return view('admin.comment.index', compact('comments'));
    }

    /**
     * 保存评论
     *
     * @param StoreCommentPost $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentPost $request)
    {
        $city = $this->commentRepository->getCity($request->ip());
        if (Auth::id()) {
            $user_id = Auth::id();
            $admin = $this->adminRepository->findAdminById($user_id);
            $avatar = $admin->avatar;
            $name = $admin->name;
        } else {
            $user_id = 0;
            $avatar = $this->identicon->getImageDataUri($request->post('email'));
            $name = $request->post('name');
        }
        $data = [
            'user_id' => $user_id,
            'parent_id' => $request->post('parent_id') ? $request->post('parent_id') : 0,
            'article_id' => $request->post('article_id'),
            'target_name' => $request->post('target_name'),
            'name' => $name,
            'avatar' => $avatar,
            'email' => $request->post('email'),
            'comment' => $request->post('comment'),
            'website' => $request->post('website'),
            'ip' => $request->ip(),
            'city' => $city['region'].' '.$city['city']
        ];
//        dd($data);
        $this->commentRepository->createComment($data);
        $article = $this->homeRepository->findSingleById($request->post('article_id'));
        $article->increment('reply_count');

        return back();
    }

    public function trash()
    {
        $comments = $this->commentRepository->findCommentTrash();
        return view('admin.comment.trash', compact('comments'));
    }

    public function delete($id)
    {
        $this->commentRepository->deleteById($id);
        return redirect('/admin/comment/index');
    }

    public function recovery($id)
    {
        $this->commentRepository->recoveryById($id);
        return redirect('/admin/comment/trash');
    }

    public function destroy($id)
    {
        $this->commentRepository->destroyById($id);
        return redirect('/admin/comment/trash');
    }
}
