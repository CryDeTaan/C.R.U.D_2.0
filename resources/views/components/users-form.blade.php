<div>
    <!-- He who is contented is rich. - Laozi -->
    <form class="w-full mx-auto text-sm" action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        <div class="flex mb-2 justify-between">
            <div class="flex items-center">
                <div>
                    <label class="block text-sm mr-2" for="name">
                        Name
                    </label>
                </div>
                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-700"
                        id="name" type="text" name="name"
                        value="{{ $user->name }}">
                </div>
            </div>
            <div class="flex items-center">
                <div>
                    <label class="block text-sm mx-2" for="name">
                        Email
                    </label>
                </div>
                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-700"
                        id="email" type="email" name="email"
                        value="{{ $user->email }}">
                </div>
            </div>
            <div class="flex items-center">
                <div>
                    <label class="block text-right mx-2" for="password">
                        Password
                    </label>
                </div>
                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-700"
                        id="password" type="password" name="password" value="password">
                </div>
                <input hidden id="password-confirm" name="password_confirmation" value="password">
            </div>
        </div>
        <div class="flex my-8 justify-between">
            <div class="flex">
                @unless (request()->actionOn == 'platform-contributor')
                    <div class="flex items-center">
                        <div>
                            <label class="block text-right mr-2" for="entity">
                                Entity
                            </label>
                        </div>
                        <div>
                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-700"
                                id="entity" type="text" name="entity"
                                value="{{ $user->entity->name }}">
                        </div>
                    </div>
                @endunless
                <div class="flex items-center">
                    <div class="block">
                        <label class="text-right mx-2" for="role">
                            Role
                        </label>
                    </div>
                    <div>
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                            text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-700"
                            id="role" type="text" name="role" value='{{ $user->roles->first()->name }}'>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <button
                    class="block ml-2 shadow bg-gray-700 hover:bg-gray-600 focus:shadow-outline focus:outline-none
                    text-white font-bold py-2 px-4 rounded">
                    {{ $button }}
                </button>
            </div>
        </div>
    </form>
</div>
