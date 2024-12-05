<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/*
 * ArticleController class
 * Define the methods for handling article resources
 * @extends Controller
 * @package App\Http\Controllers
 * @version 1.0
 */

class ArticleController extends Controller
{
    protected $articleRepository;

    /**
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $articles = $this->articleRepository->all();
        return response()->json($articles);
    }


    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $article = $this->articleRepository->find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json($article);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'author'       => 'required|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $article = $this->articleRepository->store($data);
        return response()->json($article, 201);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'author'       => 'required|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $updated = $this->articleRepository->update($id, $data);

        if (!$updated) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json(['message' => 'Article updated successfully']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $deleted = $this->articleRepository->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json(['message' => 'Article deleted successfully']);
    }
}
