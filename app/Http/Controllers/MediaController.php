<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    const MEDIA_PATH = 'medias';

    public function upload(Request $request)
    {
        $request->validate([
            'file'        => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mp3,mov,avi,pdf|max:20480',
            'url'         => 'nullable|url',
            'description' => 'nullable|string',
            'film_id'     => 'required|exists:films,id',
        ]);

        // Priorité au fichier local si présent
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();

            $path = $file->storeAs(self::MEDIA_PATH, $filename, 'public');

            $media = new Media();
            $media->type = $file->getMimeType();
            $media->url = $path; // chemin relatif sur disk public
            $media->description = $request->input('description', '');
            $media->film_id = $request->input('film_id');
            $media->save();
        } elseif ($request->filled('url')) {
            // Média externe : URL directe
            $media = new Media();
            $media->type = 'external';
            $media->url = $request->input('url');
            $media->description = $request->input('description', '');
            $media->film_id = $request->input('film_id');
            $media->save();
        }

        return back()->with('success', 'Média ajouté avec succès.');
    }

    public function delete($id)
    {
        $media = Media::findOrFail($id);

        // Si média stocké localement (url ne commence pas par http)
        if (! str_starts_with($media->url, 'http')) {
            if (Storage::disk('public')->exists($media->url)) {
                Storage::disk('public')->delete($media->url);
            }
        }

        $media->delete();

        return back()->with('success', 'Média supprimé avec succès.');
    }
}
