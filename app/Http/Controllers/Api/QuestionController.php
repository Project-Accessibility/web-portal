<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class QuestionController extends Controller
{
    public function get(int $id): Model
    {
        return Question::with(['options.answers'])->findOrFail($id);
    }
}
