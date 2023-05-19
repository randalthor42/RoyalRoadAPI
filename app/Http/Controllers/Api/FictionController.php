<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Fiction\FictionRepositoryInterface;
use App\Transformers\FictionTransformer;
use Illuminate\Http\Request;

class FictionController extends Controller
{
    /** @var FictionRepositoryInterface */
    protected $fictionRepository;

    /** @var FictionTransformer */
    protected $transformer;

    public function __construct(FictionRepositoryInterface $fictionRepository, FictionTransformer $transformer)
    {
        $this->fictionRepository = $fictionRepository;
        $this->transformer = $transformer;
    }

    public function show(Request $request, $id)
    {
        $includes = explode(',', $request->get('includes', ''));
        $novel = $this->fictionRepository->getFiction($id, $includes);
        return response()->json($novel);
    }
    
}
