<?php namespace App\Http\Controllers;

use App\Article;
//use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;

use App\Tag;
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
//		 $articles = Article::all();
//		 $articles = Article::order_by('published_at', 'desc')->get();
//		$articles = Article::latest('updated_at')->get();
		$latest = Article::latest()->first();
		// $articles = Article::latest('published_at')->where('published_at', '<=', Carbon::now())->get();
		$articles = Article::latest('published_at')->published()->get();

//		dd($articles);

		return view('articles.index', compact('articles', 'latest'));
	}

	public function show(Article $article)
	{
		// We no longer fetch the article
		// $article = Article::findOrFail($id);
		// dd($article->published_at->addDays(8)->diffForHumans());

		return view('articles.show', compact('article'));
	}

	public function create() 
	{
//		if(Auth::guest())
//		{
//			return redirect('articles');
//		}
		$tags = Tag::lists('name', 'id');
		return view('articles.create', compact('tags'));
	}

	public function store(ArticleRequest $request)
	{
//		$article = new Article($request->all());

//		dd($request->input('tags'));
//		Auth::user()->articles()->save($article);
//		$article = Auth::user()->articles()->create($request->all());
		// Article::create($request->all()); // user_id =? Auth::user()->id

//		session()->flash('flash_message', 'Your article has been created!');
//		session()->flash('flash_message_important', true);
//		flash('Your article has been created!');

//		$article->tags()->attach($request->input('tag_list'));

		$this->createArticle($request);
//		$this->syncTags($article, $request->input('tag_list'));

		flash()->success('Your article has been created!');
//		flash()->overlay('Your article has been created!', 'Good Job!');
		return redirect('articles');
	}

	public function store2(Request $request)
	{
		$this->validate($request, ['title' => 'required', 'body' => 'required']);

		Article::create($request->all());

		return redirect('articles');
	}

	public function edit(Article $article)
	{
		$tags = Tag::lists('name', 'id');
		return view('articles.edit', compact('article', 'tags'));
	}

	public function update(Article $article, ArticleRequest $request)
	{
		$article->update($request->all());

		$this->syncTags($article, $request->input('tag_list'));

		return redirect('articles');
	}

	/**
	 * Sync up the lists of tags in the database
	 * @param ArticleRequest $request
	 * @param Article $article
	 */
	private function syncTags(Article $article, array $tags)
	{
		$article->tags()->sync($tags);
	}

	/**
	 * Save a new article.
	 * @param ArticleRequest $request
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	private function createArticle(ArticleRequest $request)
	{
		$article = Auth::user()->articles()->create($request->all());
		$this->syncTags($article, $request->input('tag_list'));

//		return $article;
	}
}
