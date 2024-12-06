<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Collection;

/**
 * ArticleRepository
 * This class contains methods for interacting with the Article model.
 * @package App\Repositories
 * @version 1.0
 */
class ArticleRepository
{
    /**
     * The article model instance.
     *
     * @var Article
     */
    protected $model;

    /**
     * ArticleRepository constructor.
     *
     * @param Article $article The Article model instance
     */
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    /**
     * Get all articles.
     *
     * @return Collection A collection of Article models
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find an article by its ID.
     *
     * @param int $id The ID of the article to find
     * @return Article|null The article model if found, null otherwise
     */
    public function find(int $id): ?Article
    {
        return $this->model->find($id);
    }

    /**
     * Store a new article.
     *
     * @param array $data The data to create a new article
     * @return Article The newly created article
     */
    public function store(array $data): Article
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing article.
     *
     * @param int $id The ID of the article to update
     * @param array $data The data to update the article with
     * @return bool Whether the update was successful
     */
    public function update(int $id, array $data): bool
    {
        $article = $this->model->find($id);
        return $article ? $article->update($data) : false;
    }

    /**
     * Delete an article by its ID.
     *
     * @param int $id The ID of the article to delete
     * @return bool Whether the deletion was successful
     */
    public function delete(int $id): bool
    {
        $article = $this->model->find($id);
        return $article ? $article->delete() : false;
    }
}
