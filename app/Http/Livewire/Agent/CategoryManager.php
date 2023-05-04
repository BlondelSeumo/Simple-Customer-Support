<?php

namespace App\Http\Livewire\Agent;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryManager extends Component
{
    use WithPagination;

    public $search;
    public $category;
    public $showCategoryForm;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected function rules()
    {
        return [
            'category.name' => 'required|string|max:255',
            'category.slug' => 'nullable|string|unique:categories,slug,' . $this->category->id,
            'category.description' => 'nullable|string',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createCategory()
    {
        $this->category = new Category();
        $this->showCategoryForm = true;
    }

    public function saveCategory()
    {
        $this->validate([
            'category.name' => 'required|string|max:255',
            'category.slug' => 'nullable|string|unique:categories,slug,' . $this->category->id,
            'category.description' => 'nullable|string',
        ]);
        $this->category->save();
        $this->dispatchBrowserEvent('notify', $this->category->wasRecentlyCreated ? trans('Category has been created.') : trans('Category has been updated.'));
        $this->reset('category', 'showCategoryForm');
    }

    public function editCategory(Category $category)
    {
        $this->category = $category;
        $this->showCategoryForm = true;
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        $this->reset('category', 'showCategoryForm');
        $this->notify(trans('Category has been removed.'));
    }

    public function toggleLicenseRequirement(Category $category)
    {
        $category->is_license_required = ! $category->is_license_required;
        $category->save();
    }

    public function getCategoriesProperty()
    {
        return Category::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->withCount('tickets')
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.agent.category-manager');
    }
}
