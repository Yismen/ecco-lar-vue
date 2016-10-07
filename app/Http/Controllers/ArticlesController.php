<?php namespace App\Http\Controllers;

use App\Http\Requests\ArticlesRequest;
use App\Http\Requests\SaveImageFromURLRequest;
use App\Http\Requests\SaveImageFromLocalFileRequest;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManager;

use Illuminate\Http\Request;

use App\Article;
use App\Tag;

class ArticlesController extends Controller {


	public function __construct()
	{	
		// $this->middleware('authorize', ['except'=>['index', 'show', 'unpublished', 'search']]);	
		// $this->middleware('authorize:view_articles|edit_articles|create_articles', ['only'=>['index','show']]);
		$this->middleware('authorize:edit_articles', ['only'=>['edit','update']]);
		$this->middleware('authorize:create_articles', ['only'=>['create','store']]);
		$this->middleware('authorize:destroy_articles', ['only'=>['destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Article $article)
	{
		$articles = Cache::remember('articles', 60*3, function(){
			return Article::with('user')
				->latest('published_at')
				->published()
				->paginate(10);
		}); 

		return view('articles.index', compact('articles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Article $article, Tag $tag)
	{
	// $article = new $article;
		$tags = $tag->all()->lists('name', 'id');

		return view('articles.create', compact('article', 'tags'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Article $article, ArticlesRequest $request, Tag $tag)
	{
		// dd($request->all());
		 
		// $article = new $article($request->all());

		// \Auth::user()->articles()->save($article);
		
		$this->createArticle($article, $request, $tag);

		return \Redirect::route('articles.index')->withSuccess("$request->title has been created successfully!");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Article $article, Request $request)
	{	
		return view('articles.show', compact('article'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Article $article, Tag $tags)
	{	
		$tags = $tags->lists('name', 'id');

		return view('articles.edit', compact('article', 'tags'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Article $article, ArticlesRequest $request)
	{
		$this->updateArticle($article, $request);
		
		return \Redirect::route('articles.show', $article->slug)->withSuccess("Edited successfully...!");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Article $article)
	{
		$article->delete();

		return \Redirect::route('articles.index')->withSuccess("Article [$article->title] has been removed");
	}

	/**
	 *
	 * Retrieve Posts made by the current user that are set to be published for the future
	 *
	 * @return [array]
	 */
	public function getUnpublished(Article $articles)
	{
		
		$articles = $articles->with('user')->orderedDesc()->unpublished()->paginate(10);
		
		return view('articles.index', compact('articles'));
	}

	/**
	 * Sync the given tagas in the database
	 * 
	 * @param  Article    $article [Article Model]
	 * @param  Array|null $tagIDs  [The IDs of the tags]
	 * @return [type]              [object]
	 */
	public function syncTags(Article $article, Array $tagIDs = null)
	{
		return $article->tags()->sync((array) $tagIDs);		
	}

	/**
	 * Create a new article model
	 * 
	 * @param  Article      $article [the model to be create]
	 * @param  ArticlesRequest $request [data passed by the user]
	 * @return [type]                [object]
	 */
	public function createArticle(Article $article, ArticlesRequest $request, Tag $tag)
	{
		$tagsList = $this->insertNewTags($request->input('tag_list'), $tag);

		$article = $article->create($request->all());

		return $this->syncTags($article, $tagsList);
	}

	/**
	 * Update current article model
	 * 
	 * @param  Article      $article [the model to be updated]
	 * @param  ArticlesRequest $request [data passed by user]
	 * @return [type]                [object]
	 */
	public function updateArticle(Article $article, ArticlesRequest $request)
	{
		$article->update($request->all());

		return $this->syncTags($article, $request->input('tag_list'));
	}

	/**
	 * search for articles
	 * 
	 * @param  Request $requests [requests object]
	 * @return [type]            [view]
	 */
	public function search( Request $requests, Article $article)
	{
		$search = $requests->get('search');

		$articles = $article
			->where('title', 'LIKE', "%$search%")->orWhere('body', 'LIKE', "%$search%")
			->with('user')
			->latest('published_at')
			->published()
			->paginate(10)
			->appends(['search' => $search]);

		if ($requests->ajax()) {
			return view('articles._results', compact('articles'));
		}
		
		return view('articles.index', compact('articles'));
	}

	/**
	 * Receive the content of a local file and save an image to the server
	 * 		
	 * @param  ArticlesRequest $request The request with the fields
	 * @return [type]                   location of the save image
	 */
	public function saveImageFromLocalFile(Article $article, SaveImageFromLocalFileRequest $request)
	{
		/**
		 * set optional parameters
		 */
		$localPath = 'images/articles/'; // local folder where the image will be loaded to
		$fileName = sha1($request->input('slug')); // $fileName = str_random(40); //username sha1ed, so it is unique
		$extension = '.png'; // the destinied extension
		$extendedName = $localPath . $fileName . $extension;

		$img = file_get_contents($request->file('file'));

		$save = file_put_contents($extendedName, $img);

		if ($save) {

			$article = $article->whereSlug($request->input('slug'))->first();

			$article->main_image = $extendedName;
			$article->update();

		} else {
			# code...
		}		

		if ($request->ajax()) {
			return response()->json([
				'status' => 1, 
				'data' => $article->main_image
			]);
		}


		return response()->json(['status'=>1, 'data'=>$request->file()]);

	}

	/**
	 * Receive the content of a url and save an image to the server
	 * 		
	 * @param  ArticlesRequest $request The request with the fields
	 * @return [type]                   location of the save image
	 */
	public function saveImageFromURL(Article $article, SaveImageFromURLRequest $request)
	{
		/**
		 * set optional parameters
		 */
		$localPath = 'images/articles/'; // local folder where the image will be loaded to
		$fileName = sha1($request->input('slug')); // $fileName = str_random(40); //username sha1ed, so it is unique
		$extension = '.png'; // the destinied extension
		$extendedName = $localPath . $fileName . $extension;

		$img = file_get_contents($request->input('url'));

		$save = file_put_contents($extendedName, $img);

		if ($save) {

			$article = $article->whereSlug($request->input('slug'))->first();

			$article->main_image = $extendedName;
			$article->update();

		} else {
			return $save;
		}		

		if ($request->ajax()) {
			return response()->json([
				'status' => 1, 
				'data' => $article->main_image
			]);
		}


		return response()->json(['status'=>1, 'data'=>$request->file()]);
	}

	/**
	 * Interset the tags object and save to the database
	 * those that has not been saved yet
	 * 
	 * @param  Array  $selected  [description]
	 * @param  [type] $tagObject [description]
	 * @return [type]            [description]
	 */
	public function insertNewTags($tagsArray, Tag $tags)
	{
		return $tagsArray;

		$newTags = array_diff($tagsArray, $tags->lists('id')); // get the tags that are missing

		foreach ($newTags as $key => $value) {

			if ( ! $tags->find($value) ) {

				if (isset($tagsArray[$key])) {

					unset($tagsArray[$key]);

				}

				$tags->name = $value;
				$tags->save(); //add the new unexistent tag to the Tag model

				array_push($tagsArray, $tags->id); //add just created tag to the array

			}	

		}		
		return $tagsArray;
	}
}
