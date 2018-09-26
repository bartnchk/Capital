<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    public function destroy( Document $document ) {

        if ($document->delete()){
            return response()->json( [
                "class" => "success", "message" => 'Документ удален.'
            ] );
        }
    }
}
