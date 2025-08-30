<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;

class CategoryService
{

    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll(array $fields)
    {
        return $this->categoryRepository->getAll($fields);
    }

    public function getById(int $id, array $fields)
    {
        return $this->categoryRepository->getById($id, $fields ?? ['*']);
    }

    public function create(array $data)
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $data['photo'] = $this->UploadPhoto($data['photo']);
        }
        return $this->categoryRepository->create($data);
    }
    private function UploadPhoto(UploadedFile $photo)
    {
        return $photo->store('categories', 'public');
    }
}
