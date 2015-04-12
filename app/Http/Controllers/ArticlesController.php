<?php namespace App\Http\Controllers;

use App\Article;
// use App\Http\Requests;
// use App\Http\Requests\CreateArticleRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
// use Request;

class ArticlesController extends Controller {

	public function index()
	{
		// $articles = Article::all();
		// $articles = Article::order_by('published_at', 'desc')->get();
		// $articles = Article::latest('published_at')->get();
		// $articles = Article::latest('published_at')->where('published_at', '<=', Carbon::now())->get();
		$articles = Article::latest('published_at')->published()->get();


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
		return view('articles.create');
	}

	public function store(CreateArticleRequest $request)
	{

		Article::create($request->all());

		return redirect('articles');
	}

	public function store2(Request $request)
	{
		$this->validate($request, ['title' => 'required', 'body' => 'required']);

		Article::create($request->all());

		return redirect('articles');
	}

}
