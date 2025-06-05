<div class="admin_content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <div class="admin">
        <div class="admin-menu">
            <a href=""class="export">
                エクスポート
                </a>
            <div class="mt-4">
                @if ($contacts->hasPages())
                    <nav lole="navigation" aria-label="Pagination Navigation">
                        @if ($contacts->onFirstPage())
                            <span>&lt;</span>
                        @else
                            <button wire:click="previousPage">&lt;</button>
                        @endif
                        @for ($page = 1; $page <= $contacts->lastPage(); $page++)
                            @if ($page == $contacts->currentPage())
                                <span>{{ $page }}</span>
                            @else
                                <button wire:click="gotoPage({{ $page }})">
                                    {{ $page }}
                                </button>
                            @endif
                        @endfor
                        @if ($contacts->hasMorePages())
                                <button wire:click="nextPage">&gt;</button>
                        @else
                            <span class="px-3 py-1 text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed">&gt;</span>
                        @endif
                    </nev>
                @endif
            </div>
        </div>
    </div>
    <div class="admin-search">
        <div class="admin-search__item">
            <input type="text" wire:model.defer="keyword" class="admin-search__item-input" placeholder="名前やメールアドレスを入力してください">
            <select wire:model.defer="gender" class="admin-search__item-input">
                <option value="">性別</option>
                <option value="all">全て</option>
                @foreach($contacts->unique('gender') as $contact)
                    <option value="{{ $contact->gender }}">{{ $contact->gender_label }}</option>
                @endforeach
            </select>

            <select wire:model.defer="category_id" class="admin-search__item-input">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->content }}</option>
                @endforeach
            </select>
            <input type="date" wire:model.defer="date" class="admin-search__item-input">
            <div class="admin-search__button">
                <button wire:click="search" class="admin-search__button-submit" type="button">検索</button>
                <a wire:click="reset" class="admin-search__button-reset">リセット</a>
            </div>
        </div>
    </div>
    <div class="admin-table">
        <table class="admin-table__inner">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>性別</th>
                    <th>メール</th>
                    <th>お問い合わせの種類</th>
                    <th>お問い合わせ内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>{{ $contact->gender_label }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $categories->firstWhere('id', $contact->category_id)->content ?? '' }}</td>
                    <td>
                        <button wire:click="openModal({{ $contact->id }})" >
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($showModal && $selectedContact)
    <div class="modal-overlay">
        <div class="modal-content">
            <div class="flex justify-end">
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-800 text-xl">✕</button>
            </div>
            <table class="table-auto w-full mt-4">
                <tr><th class="text-left">名前</th><td>{{ $selectedContact->last_name }} {{ $selectedContact->first_name }}</td></tr>
                <tr><th class="text-left">性別</th><td>{{ $selectedContact->gender_label }}</td></tr>
                <tr><th class="text-left">メール</th><td>{{ $selectedContact->email }}</td></tr>
                <tr><th class="text-left">電話番号</th><td>{{ $selectedContact->tel }}</td></tr>
                <tr><th class="text-left">住所</th><td>{{ $selectedContact->address }}</td></tr>
                <tr><th class="text-left">建物名</th><td>{{ $selectedContact->building }}</td></tr>
                <tr><th class="text-left">お問い合わせ種類</th>
                    <td>{{ $categories->firstWhere('id', $selectedContact->category_id)->content ?? '未分類' }}</td></tr>
                <tr><th class="text-left">内容</th><td>{{ $selectedContact->detail }}</td></tr>
            </table>

            <button wire:click="deleteContact" class="bg-red-500 text-white px-4 py-2 rounded mt-4">
                削除
            </button>
        </div>
    </div>
    @endif
</div>
