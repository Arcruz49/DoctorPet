<?php

namespace App\Http\Controllers;

use App\Models\cadDocumento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function getDocumentos(Request $request)
    {
        $documentos = cadDocumento::where('cdPaciente', $request->input('cdPaciente'))->get();

        return response()->json($documentos);

    }
}
