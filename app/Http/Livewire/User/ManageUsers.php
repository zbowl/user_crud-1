<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

/**
 *
 */
class ManageUsers extends Component
{

    public $users;
    public array $newUsers = [];

    public bool $newUserInputFieldOpen = false;
    public array $emailDomains = [
        '@example.com',
        '@example.net',
        '@example.org',
        '@test.com',
        '@test.test',
    ];

    /**
     * Rules outlined for users and newUsers.
     * These will be validated in saveUser() and storeUser()
     *
     * @var string[]
     */
    protected $rules = [
        'users.*.name' => 'required|min:6',
        'users.*.username' => 'required|min:4',
        'users.*.email' => 'required|email',
        'users.*.password' => 'required|min:6',
        'newUsers.*.name' => 'required|min:6',
        'newUsers.*.username' => 'required|min:4',
        'newUsers.*.email' => 'required|email',
        'newUsers.*.password' => 'required|min:6',
    ];

    /**
     * Listening for a refreshUsers event to be emitted
     * Once it receives event it will execute the refreshUsers() method
     *
     *
     * @var string[]
     */
    protected $listeners = [
        'refreshUsers' => 'refreshUsers',
    ];


    /**
     * Initializing/Constructing
     *
     * @return void
     */
    public function mount(): void
    {
        $this->users = User::all();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.user.manage-users');
    }

    /**
     * Saving any updates made through the Edit.
     *
     * @return void
     */
    public function saveUser(): void
    {
        $this->validate();

        foreach ($this->users as $user) {
            $user->save();
        }

    }

    /**
     * We will delete the user then refreshUsers to reload the list of users
     *
     * @param User $user
     * @return void
     * @throws \Throwable
     */
    public function deleteUser(User $user): void
    {
        $user->deleteOrFail();
        $this->emit('refreshUsers');
    }

    /**
     * Storing new user data
     *
     * @return void
     */
    public function storeUser(): void
    {
        if (!empty($this->newUsers)) {
            $this->validate();

            foreach ($this->newUsers as $newUser) {
                User::create([
                    'name' => $newUser['name'],
                    'username' => $newUser['username'],
                    'email' => $newUser['email'],
                    'password' => bcrypt($newUser['password'])
                ]);
            }
            $this->emit('refreshUsers');
        }
    }

    /**
     * Resetting properties.
     * newUsers - so we can reset the input fields added from the alpine template
     * newUserInputFieldOpen - so the Save button gets removed
     * users - so we get a fresh list of existing users
     *
     *
     * @return void
     */
    public function refreshUsers(): void
    {
        $this->newUsers = [];
        $this->newUserInputFieldOpen = false;
        $this->users = User::all();
    }

    /**
     * I wanted to showcase someway to incorporate some Eloquent magic.
     * Using a hard coded array of $emailDomains.
     *
     * User::ofEmailDomain - $query->where('email','like','%' . $emailDomain)
     *
     * @param $emailDomain
     * @return void
     */
    public function filterDomain($emailDomain): void
    {
        $this->users = User::ofEmailDomain($emailDomain)->get();
    }

    /**
     * Resetting properties.
     *
     * @return void
     */
    public function resetFilters(): void
    {
        $this->users = User::all();
    }

}
