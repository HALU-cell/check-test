<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AdminModal extends Component
{
    use WithPagination;

    public $showModal = false;
    public $selectedContact = null;
    public $categories;

    public $keyword = '';
    public $gender = '';
    public $category_id = '';
    public $date = '';

    public $genderLabels = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];


    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        $query = Contact::query();

        $contacts = $query->paginate(7);

        foreach ($contacts as $contact) {
            $contact->gender_label = $this->genderLabels[$contact->gender] ?? '不明';
        }

        return view('livewire.admin-modal', [
            'contacts' => $contacts,
            'categories' => $this->categories,
        ]);
    }

    public function openModal()
    {
            $this->showModal = true;

    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
