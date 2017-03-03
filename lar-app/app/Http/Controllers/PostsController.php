<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\StoreBlogPostRequest;
use App\Markdown\Markdown;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Store;
use YuanChao\Editor\EndaEditor;

/**
 * Class PostsController
 * @package App\Http\Controllers
 */
class PostsController extends Controller
{
    protected $markdown;
    /**
     * PostsController constructor.
     */
    public function __construct(Markdown $markdown)
    {
        $this->middleware('auth_user', ['only'=>['create', 'store', 'edit', 'update']]);
        $this->markdown = $markdown;
    }

    public function index()
    {
        $discussions = Discussion::latest()->get();
        return view('forum.index', compact('discussions'));
    }
    public function create()
    {
        return view('forum.create');
    }
    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);

        if(\Auth::user()->id !== $discussion->user_id) {
            return redirect('/');
        }

        return view('forum.edit', compact('discussion'));
    }
    public function update(StoreBlogPostRequest $request, $id)
    {
        $discussion = Discussion::findOrFail($id);
        $discussion->update($request->all());

        return redirect()->action('PostsController@show', ['id'=>$id]);
    }
    public function upload()
    {
        // endaEdit 为你 public 下的目录 update 2015-05-19
        $data = EndaEditor::uploadImgFile('uploads');

        return json_encode($data);
    }
    public function store(StoreBlogPostRequest $request)
    {
        $data = [
            'user_id'=>\Auth::user()->id,
            'last_user_id'=>\Auth::user()->id
        ];
        $discussion = Discussion::create(array_merge($request->all(), $data));

        return redirect()->action('PostsController@show', ['id'=>$discussion->id]);
    }
    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        $html = $this->markdown->markdown($discussion->body);
        return view('forum.show', compact('discussion', 'html'));
    }
}
