<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class QuestionController extends Controller
{
    public function get(int $question, string $code): Model
    {
        return Question::with([
            'options.answers' => function (HasMany $answers) use ($code) {
                $answers->whereHas('participant', function (
                    Builder $participant,
                ) use ($code) {
                    $participant->where('code', $code);
                });
            },
        ])->findOrFail($question);
    }

    public function answer(Request $request): JsonResponse
    {
        // validation
        $this->validate($request, [
            'audio' => 'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,aac'
        ]);

        $audio = $request->file('audio');
        // code for upload 'audio'
        // handle multiple files
        if (is_array($audio)) {
            $audios = array();
            foreach ($audio as $file) {
                $uniqueid = uniqid();
                $extension = $file->getClientOriginalExtension();
                $filename = Carbon::now()->format('Ymd') . '_' . $uniqueid . '.' . $extension;
                $audiopath = url('/storage/upload/files/audio/' . $filename);
                $file->storeAs('/upload/files/audio', $filename);
                $audios[] = $audiopath;
                $all_audios=implode(",",$audios);
            }
        } else {
            // handle single file
            if ($audio) {
                $uniqueid = uniqid();
                $extension = $audio->getClientOriginalExtension();
                $filename = Carbon::now()->format('Ymd') . '_' . $uniqueid . '.' . $extension;
                $audiopath = url('/storage/upload/files/audio/' . $filename);
                $audio->storeAs('public/upload/files/audio/', $filename);
                $all_audios=$audiopath;
            }
        }
        return response()->json([
            'audio' => $all_audios
        ]);
    }
}
