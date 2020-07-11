<p>
    For more information about the <code class="myCode">get_role()</code> helper function I use in the controller please
    see <a class="text-blue-500" href="/helper">this</a>.
</p>

<div class="p-1 border rounded-md">
    <pre><code class="text-xs bg-gray-200 php">&lt;?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    {{ $slot }}

}</code></pre>
</div>
