<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('form.index');
});
//Route::resource('/api/athletePhoto','athletesPhotoController');
//Route::resource('/api/athleteInfo','athletesController');
//Route::get('/api/athleteCompatibleEvents/{match_id}/{shooterID}','eventsController@athleteCompatibleEvents');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('scores/match_id/{match_id}', ['as'=>'indexForSelectingClass','uses'=> 'scoresController@indexForSelectingClass']);
Route::get('scores/match_id/{match_id}/class_id/{class_id}', ['as' => 'getScoresByClass', 'uses' => 'scoresController@indexForMatchAndClass']);
Route::post('scores/match_id/{match_id}/class_id/{class_id}', ['as' => 'storeScoresByClass', 'uses' => 'scoresController@storeForMatchAndClass']);
Route::get('scores/match_id/{match_id}/class_id/{class_id}/gender/{gender}', ['as' => 'getScoresByClassAndGender', 'uses' => 'scoresController@indexForMatchAndClassAndGender']);

Route::get('scores/match_id/{match_id}/class_id/{class_id}/gender/{gender}/category/{category}',
    ['as' => 'getScoresByClassAndGenderAndCategory',
        'uses' => 'scoresController@indexForMatchAndClassAndGenderAndCategory']);

Route::resource('matches', 'matchesController');
Route::resource('events', 'eventsController');
Route::resource('scores', 'scoresController');
Route::resource('athletes', 'athletesController');
Route::get('relays/match_id/{match_id}/class_id/{class_id}/gender/{gender}',['as'=>'getRelaysByClassAndGender','uses'=>'relayController@indexClassAndGender']);
Route::get('matches/{match_id}/relays/print', 'relayController@printIndex');
Route::resource('matches/{match_id}/relays', 'relayController');

//Route::resource('events','eventsController');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.home');
    });
});
/**
 * Example routes for reference.
 */
/*Route::get('/example/photo/{id}',function($id){

    $img = Image::make(storage_path('shooter_i_d_photos/'.$id.'.jpg'))->resize(300, 300);
    return $img->response("jpg");
});
*/
Route::get('relay', function () {
    $class_id = 0;
    $match_id = 1;
    $entries = unserialize(file_get_contents(storage_path('app/request.txt')));
    $class = \App\Event::decodeArray()['classes'][$class_id];
    foreach ($entries as $entry) {
        //Set Relay Number
        DB::table('scores')
            ->where('athlete_id', '=', $entry->athlete_id)
            ->whereIn('event_id', function ($query) use ($match_id, $class) {
                $query->from('events')
                    ->select('id')
                    ->where('class', '=', $class)
                    ->where('match_id', '=', $match_id);
            })
            ->update(['relay_no' => $entry->relay_no]);
    }
    return $entries;
});
Route::get('letterhead', function () {
    set_time_limit(0);
    //return view('phpinfo');
    //return PDF::loadFile('http://www.github.com')->download('github.pdf');
    return PDF::loadFile(storage_path('app/index.htm'))->setPaper('a4')->setOrientation('portrait')->setOption('margin-bottom', 0)->stream('download.pdf');


    //return PDF::loadHTML('<h1>HI</h1>')->download('hi.pdf');
    //$pdf = App::make('snappy.pdf.wrapper');
    //$pdf->loadHTML('<h1>Test</h1>');
    //return $pdf->stream();
});
Route::get('test/{eventClass}',function($eventClass){
    return \Response::json($eventClass);
});