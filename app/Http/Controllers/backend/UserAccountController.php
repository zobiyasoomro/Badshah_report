<?php

        namespace App\Http\Controllers\Backend;

        use App\Models\UserAccount;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use Illuminate\Validation\Rule;

        class UserAccountController extends Controller
        {
            public function index()
            {
                $userAccounts = UserAccount::latest()->get();

                return view('admin.pages.UserAccounts.index', compact('userAccounts'));
            }

            public function create()
            {
                return view('admin.pages.UserAccounts.create');
            }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'user_account'  => ['required', 'string', 'max:255', 'unique:user_accounts,user_account'],
                'user_password' => ['required', 'string', 'min:6'],
            ]);

            UserAccount::create($validated);

            return redirect()
                ->route('admin.UserAccounts')
                ->with('success', 'Account created successfully.');
        }

        public function destroy(UserAccount $userAccount)
        {
            $userAccount->delete();

            return redirect()
                ->route('admin.UserAccounts')
                ->with('success', 'Account deleted successfully.');
        }
        }