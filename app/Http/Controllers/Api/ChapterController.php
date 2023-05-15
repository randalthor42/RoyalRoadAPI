<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Chapter\ChapterRepositoryInterface;

class ChapterController extends Controller
{
    protected $chapterRepository;

    public function __construct(ChapterRepositoryInterface $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;
    }

    public function show(Request $request, $id)
    {
        $chapters = $this->chapterRepository->getChapters($id);

        return response()->json($chapters);
    }
}
