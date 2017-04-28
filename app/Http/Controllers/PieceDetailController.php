<?php

namespace App\Http\Controllers;

use App\Piece;
use Validator;
use Illuminate\Http\Request;
use App\Services\FileUploader\PhotoUploader;

class PieceDetailController extends Controller
{
    /**
     * @param Request $request
     * @param Piece $piece
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request, Piece $piece)
    {

        $v = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,bmp,png,gif',
        ]);

        if ($v->fails())
        {
            if ($request->ajax()) {
                return response()->json(['error' => $v->errors()->first()], 422);
            }

            return redirect()->back()->withErrors($v->errors());
        }

        $file = $request->file('file');

        return (new PhotoUploader($piece, $file))->save();
    }

    /**
     * @param Piece $piece
     * @return mixed
     */
    public function show(Piece $piece)
    {
        return $piece->details;
    }
}
