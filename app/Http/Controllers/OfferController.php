<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page');
        $search = urldecode($request->input('search'));
        $id = urldecode($request->input('id'));
        $company = urldecode($request->input('company'));
        $creator = urldecode($request->input('creator'));
        $startDate = urldecode($request->input('startDate'));
        $endDate = urldecode($request->input('endDate'));
        $type = urldecode($request->input('type'));

        $query = Offer::orderBy('id', 'desc');

        $query->where(function ($query) use ($id, $company, $creator, $search, $startDate, $endDate, $type) {
            if ($id) {
                $query->where('id', $id);
            }

            if ($company) {
                $query->where('cadena', 'like', '%' . $company . '%');
            }

            if ($creator) {
                $query->where('usuario', 'like', '%' . $creator . '%');
            }

            if ($search) {
                $query->where('titulo', 'like', '%' . $search . '%');
            }

            if ($startDate) {
                $query->where('fecha_inicio', '>=', $startDate);
            }

            if ($endDate) {
                $query->where('fecha_fin', '<=', $endDate);
            }

            if ($type && $type !== 'both') {
                $query->where('tipo_oferta', $type);
            }
        });

        if ($perPage) {
            return $query->paginate($perPage);
        } else {
            return $query->get();
        }
    }
    public function showOnly($id){ 
        try {
            $offer = Offer::findOrFail($id);
            return response()->json($offer, 200);
        } catch (\Exception $e) {
            Log::error('Error fetching offer: ' . $e->getMessage());
            return response()->json(['message' => 'Offer not found'], 404);
        }
    }
    public function show($id)
    {
        $offer = Offer::find($id);

        if (!$offer) {
            return redirect()->route('viewOffers')->with('error', 'Offer not found');
        }

        return view('viewOffer', compact('offer'));
    }
    public function edit($id)
    {
        $offer = Offer::find($id);

        if (!$offer) {
            return redirect()->route('viewOffers')->with('error', 'Offer not found');
        }

        return view('editOffer', compact('offer'));
    }

        public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:75',
            'descripcion' => 'required|string|max:150',
            'tipo_oferta' => 'required|in:descuento,cupon',
            'codigo_cupon' => 'nullable|string|max:11',
            'cadena' => 'required|string|max:50',
            'provincia' => 'required|string|max:75|regex:/^[^\d]*$/',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'precio_original' => 'required|numeric',
            'precio_descuento' => 'required|numeric|lt:precio_original',
            'enlace' => 'required|url|regex:/^https?:\/\/www\./',
        ]);

        $offer = Offer::findOrFail($id);
        $offer->titulo = $request->input('titulo');
        $offer->descripcion = $request->input('descripcion');
        $offer->tipo_oferta = $request->input('tipo_oferta');
        $offer->codigo_cupon = $request->input('tipo_oferta') === 'cupon' ? $request->input('codigo_cupon') : 'No cupon';
        $offer->cadena = $request->input('cadena');
        $offer->provincia = $request->input('provincia');
        $offer->fecha_inicio = $request->input('fecha_inicio');
        $offer->fecha_fin = $request->input('fecha_fin');
        $offer->precio_original = $request->input('precio_original');
        $offer->precio_descuento = $request->input('precio_descuento');
        $offer->enlace = $request->input('enlace');
        $offer->save();

        return response()->json(['message' => 'Offer updated successfully'], 200);
    }

    public function destroy($id)
    {
        try {
            $offer = Offer::findOrFail($id);
            $offer->delete();
            return response()->json(['message' => 'Offer deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting offer: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete offer'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:75',
            'descripcion' => 'required|string|max:150',
            'tipo_oferta' => 'required|in:descuento,cupon',
            'codigo_cupon' => 'nullable|string|max:11',
            'cadena' => 'required|string|max:50',
            'provincia' => 'required|string|max:75|regex:/^[^\d]*$/',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'precio_original' => 'required|numeric',
            'precio_descuento' => 'required|numeric|lt:precio_original',
            'enlace' => 'required|url|regex:/^https?:\/\/www\./',
        ]);

        Log::info('Request data:', $request->all());

        $usuario = Auth::user()->name;

        $offer = new Offer();
        $offer->titulo = $request->input('titulo');
        $offer->descripcion = $request->input('descripcion');
        $offer->tipo_oferta = $request->input('tipo_oferta');
        $offer->codigo_cupon = $request->input('tipo_oferta') === 'cupon' ? $request->input('codigo_cupon') : 'No cupon';
        $offer->cadena = $request->input('cadena');
        $offer->provincia = $request->input('provincia');
        $offer->fecha_inicio = $request->input('fecha_inicio');
        $offer->fecha_fin = $request->input('fecha_fin');
        $offer->precio_original = $request->input('precio_original');
        $offer->precio_descuento = $request->input('precio_descuento');
        $offer->enlace = $request->input('enlace');
        $offer->usuario = $usuario;
        $offer->save();

        return response()->json(['message' => 'Offer created successfully'], 201);
    }
}
