<div class="flex justify-center mx-auto">
    <!-- He who is contented is rich. - Laozi -->
    <form class="w-full max-w-lg" action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                    Name
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3
                    px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="name" name="name" type="text"
                    value="{{ $resource->name ?? Faker\Factory::create()->name }}">
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                    Password
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3
                    px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="password" name="password" type="password"
                    value="password">
                <input hidden id="password-confirm" name="password_confirmation" value="password">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                    Email
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3
                    px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="email" name="email" type="email"
                    value="{{ $resource->field ?? Faker\Factory::create()->email }}">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="entity">
                    Entity
                </label>
                @if(request()->actionOn == 'platform-contributor')
                    <div
                        class="block w-full bg-white text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight
                    cursor-not-allowed select-none"
                    >
                        N/A
                    </div>
                @else
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-gray-200 border border-gray-500 text-gray-700 py-3 px-4
                        pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="entity" name="entity">
                            @foreach( App\Entity::all() as $entity)
                                <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                @endif
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <div class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="role">
                    Role
                </div>
                <div
                    class="block w-full bg-white text-gray-700 border border-gray-400 rounded py-3 px-4 leading-tight
                    cursor-not-allowed select-none">
                    {{ request()->actionOn }}
                </div>
                <input hidden id="role" name="role" value="{{ request()->actionOn }}">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3">
                <button
                    class="w-full block shadow bg-gray-700 hover:bg-gray-600 focus:shadow-outline focus:outline-none
                    text-white font-bold py-2 px-4 rounded">
                    {{ $button }}
                </button>
            </div>
        </div>

    </form>
</div>
