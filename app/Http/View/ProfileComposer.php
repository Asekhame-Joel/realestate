<?php
// app/Http/View/Composers/ProfileComposer.php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileComposer
{
    public function compose(View $view)
    {
        $userId = Auth::id();
        $profileData = User::find($userId);
        Log::info('Profile Data:', ['profileData' => $profileData]);
        $view->with('profileData', $profileData);
    }
}
