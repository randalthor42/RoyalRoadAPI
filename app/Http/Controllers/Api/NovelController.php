<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Novel\NovelRepositoryInterface;
use App\Transformers\NovelTransformer;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    protected $novelRepository;
    protected $transformer;

    public function __construct(NovelRepositoryInterface $novelRepository, NovelTransformer $transformer)
    {
        $this->novelRepository = $novelRepository;
        $this->transformer = $transformer;
    }

    public function show($id)
    {
        $novel = $this->novelRepository->getNovel($id);
        $novel = $this->transformer->transform($novel);

        return response()->json($novel);
    }
}
