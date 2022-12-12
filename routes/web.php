<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/select', function(){

    $user = User::firstWhere('name', request('name'));

    dd($user);
});

Route::get('/where', function(User $user){
    $filter = 'ab';

    $user = $user->where('name', 'LIKE', "%{$filter}%")
                ->Where(function($query){
                    $query->where('email', 'wwisoky@example.net');
                    $query->where('id', 7);
                })->toSql();
    dd($user);
});

Route::get('/paginacao', function(){
    $filter = request('filter'); // esse atributo deve ser passado na rota junto a um '?' ex: http://127.0.0.1:8000/paginacao?filter=v&total=2&page=2
    $totalPaginas = request('total', 10); //total de itens que serão trazidos na pagina
    //$users = User::paginate();
    //$users = User::where('name', 'LIKE', '%a%')->paginate();
    $users = User::where('name', 'LIKE', "%{$filter}%")->paginate($totalPaginas);
    return $users;
});

Route::get('/orderby', function(){
    $users = User::orderBy('name')->get();
    return $users;
});

Route::get('/insert', function(Post $post){
    $post->user_id = 2;
    $post->title = 'primeiro post ' . Str::random(10);
    $post->body = 'Testando o primeiro post';
    $post->date = date('Y-m-d');
    $post->save();
    
    $posts = Post::get();
    return $posts;
});

Route::get('/insert2', function(){
    $post = Post::create([
        'user_id' => 3,
        'title' => 'qual quer um',
        'body' => 'teste3 para testar',
        'date' => date('y-m-d')
    ]);

    $posts = Post::get();
    return $posts;
});

Route::get('/update', function(){
    $post = Post::find(1);

    $post->title = 'Novo titulo';
    $post->save();

    return $post; 
});

Route::get('/delete', function(){
    //Post::destroy(1,2,3,4); // esse metodo consegue deletar varios ids apenas com uma requisição
    $post = Post::find(5);

    if(!$post)
        return 'Post não encontrado';

    dd($post->delete());

});

Route::get('/acessor', function(){
    $post = Post::first();
    return $post->title_and_body;
});

Route::get('/mutaturs', function(){
    $user = User::first();
    $post = Post::create([
        'user_id' => $user->id,
        'title' => 'olá mundo',
        'body' => Str::random(20),
        'date' => now()
    ]);

    return $post;
});

Route::get('/', function () {
    return view('welcome');
});
