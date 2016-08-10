<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stringer;

class ToolsController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}


	public function stringer(Request $request) {

		$treadRun = $request->input('treadRun');
		$maxTreadRise = $request->input('maxTreadRise');
		$boardWidth = $request->input('boardWidth');
		$deckingHeight = $request->input('deckingHeight');
		$heightOfStairs = $request->input('totalHeight');


		$stringer = Stringer::calculateByTotalHeight($boardWidth, $treadRun, $deckingHeight, $heightOfStairs);
		$data = $stringer->getAttributes();

		return view('tools.stringer', array(
			'item'=>$stringer
		));

	}

}
