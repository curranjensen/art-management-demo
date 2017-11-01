<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'PagesController@index');

Route::get('catalogue', 'CatalogueController@index')->name('catalogue.index');

Route::post('pieces/{piece}/details', 'PieceDetailController@store')->name('pieces.details.store');
Route::get('pieces/{piece}/details', 'PieceDetailController@show')->name('pieces.details.show');
Route::get('pieces/{piece}/confirm-delete', 'PieceController@confirmDelete')->name('pieces.confirm-delete');
Route::resource('pieces', 'PieceController');

Route::get('/details/random', 'PagesController@randomDetail')->name('details.random');
Route::get('details/{detail}/confirm-delete', 'DetailController@confirmDelete')->name('details.confirm-delete');
Route::get('details/{detail}/download-original', 'DetailController@downloadOriginal')->name('details.download-original');
Route::get('details/{detail}/download-watermarked', 'DetailController@downloadWatermarked')->name('details.download-watermarked');
Route::get('details/{detail}/crop', 'DetailController@showCrop')->name('details.crop');
Route::post('details/{detail}/crop', 'DetailController@cropWatermark');
Route::get('details/{detail}/crop-original', 'DetailController@showCropOriginal')->name('details.crop-original');
Route::post('details/{detail}/crop-original', 'DetailController@cropOriginal');
Route::get('details/{detail}/rotate', 'DetailController@showRotate')->name('details.rotate');
Route::post('details/{detail}/rotate', 'DetailController@rotate');
Route::patch('details/{detail}/tags', 'DetailTagController@update');
Route::post('details/{detail}/default', 'DetailController@makeDefault')->name('details.default');
Route::delete('details/{detail}/default', 'DetailController@removeDefault');
Route::post('details/{detail}/in-catalogue', 'DetailController@addToCatalogue')->name('details.in-catalogue');
Route::delete('details/{detail}/in-catalogue', 'DetailController@removeFromCatalogue');
Route::post('details/{detail}/is-featured', 'DetailController@addToFeatured')->name('details.is-featured');
Route::delete('details/{detail}/is-featured', 'DetailController@removeFromFeatured');
Route::resource('details', 'DetailController', ['except' => [
    'create', 'store', 'edit', 'update'
]]);

Route::get('api/tags', 'TagController@ajaxIndex');
Route::resource('tags', 'TagController');

Route::get('export', 'ExportController@index')->name('export.index');

Route::get('export/pdf/details/list/download', 'ExportController@downloadPDFDetailsList')->name('export.pdf.details.list.download');
Route::get('export/pdf/pieces/list/download', 'ExportController@downloadPDFPiecesList')->name('export.pdf.pieces.list.download');
Route::get('export/pdf/details/grid/download', 'ExportController@downloadPDFDetailsGrid')->name('export.pdf.details.grid.download');
Route::get('export/pdf/pieces/grid/download', 'ExportController@downloadPDFPiecesGrid')->name('export.pdf.pieces.grid.download');

Route::get('export/pdf/details/list', 'ExportController@showPDFDetailsList')->name('export.pdf.details.list.show');
Route::get('export/pdf/pieces/list', 'ExportController@showPDFPiecesList')->name('export.pdf.pieces.list.show');
Route::get('export/pdf/details/grid', 'ExportController@showPDFDetailsGrid')->name('export.pdf.details.grid.show');
Route::get('export/pdf/pieces/grid', 'ExportController@showPDFPiecesGrid')->name('export.pdf.pieces.grid.show');

Route::get('export/excel/details', 'ExportController@downloadExcelDetails')->name('export.excel.details');
Route::get('export/excel/pieces', 'ExportController@downloadExcelPieces')->name('export.excel.pieces');
Route::get('export/excel/combined', 'ExportController@downloadExcelCombined')->name('export.excel.combined');

Route::get('search', 'SearchController@search')->name('search.search');