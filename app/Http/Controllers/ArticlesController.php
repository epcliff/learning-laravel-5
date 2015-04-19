<?php namespace App\Http\Controllers;

use App\Article;
//use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;

use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use Request;

class ArticlesController extends Controller {

	public function __construct()
	{
	    $this->middleware('auth', ['except' => 'index']);
	}

	public function index()
	{
//		return \Auth::user();
		// $articles = Article::all();
		// $articles = Article::order_by('published_at', 'desc')->get();
		// $articles = Article::latest('published_at')->get();
		// $articles = Article::latest('published_at')->where('published_at', '<=', Carbon::now())->get();
		$articles = Article::latest('published_at')->published()->get();

//		dd($articles);

		return view('articles.index', compact('articles'));
	}

	public function show($id)
	{
		$article = Article::findOrFail($id);

		// dd($article->published_at->addDays(8)->diffForHumans());

		return view('articles.show', compact('article'));
	}

	public function create() 
	{
//		if(Auth::guest())
//		{
//			return redirect('articles');
//		}
		return view('articles.create');
	}

	public function store(ArticleRequest $request)
	{
		$article = new Article($request->all());

		Auth::user()->articles()->save($article);
		// Article::create($request->all()); // user_id =? Auth::user()->id

		return redirect('articles');
	}

	public function store2(Request $request)
	{
		$this->validate($request, ['title' => 'required', 'body' => 'required']);

		Article::create($request->all());

		return redirect('articles');
	}

	public function edit($id)
	{
		$article = Article::findOrFail($id);
		return view('articles.edit', compact('article'));
	}

	public function update($id, ArticleRequest $request)
	{
		$article = Article::findOrFail($id);
		$article->update($request->all());
		return redirect('articles');
	}
}
