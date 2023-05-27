<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Fiction\FictionRepositoryInterface;
use App\Repositories\Chapter\ChapterRepositoryInterface;
use Illuminate\Http\Request;

class FictionController extends Controller
{
    /** @var FictionRepositoryInterface */
    protected $fictionRepository;

    /** @var ChapterRepositoryInterface */
    protected $chapterRepository;

    public function __construct(FictionRepositoryInterface $fictionRepository, ChapterRepositoryInterface $chapterRepository)
    {
        $this->fictionRepository = $fictionRepository;
        $this->chapterRepository = $chapterRepository;
    }

    public function show(Request $request, $website, $id)
    {    
        $includes = explode(',', $request->get('includes', ''));
        $fiction = $this->fictionRepository->getFiction($id, $includes);
    
        return response()->json($fiction);
    }

    public function chapters(Request $request, $id)
    {
        $chapters = $this->chapterRepository->getChapters($id);
        return response()->json($chapters);
    }

    public function showChapter(Request $request, $fictionId, $chapterId)
    {
        $chapter = $this->chapterRepository->getChapter($fictionId, $chapterId);
        return response()->json($chapter);
    }
}
