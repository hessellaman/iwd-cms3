<?php

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/admin', function() {
    return view('admin.index');
})->middleware('admin');

// Ik heb hier except toegepast ipv in de controllers zelf bij de constructor omdat ik dit fijner vond werken
Route::resource('/admin/pages', 'PagesController', ['except' => ['show']]);

Route::resource('/admin/blog', 'BlogController', ['except' => [
    'show'
]]);

Route::resource('/admin/users', 'UsersController', ['except' => [
    'create','store','show'
]]);

Route::get('/blog', 'BlogPostController@index')->name('blog');
Route::get('/blog/{slug}', 'BlogPostController@view')->name('blog.view');

Route::get('/blog/tags/{tag}', 'TagsController@index');

Route::resource('/blog/{post}/comments', 'CommentsController');
Route::get('/delete/{comment}', 'CommentsController@destroy');
