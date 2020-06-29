<li id="{{ Str::of($name)->lower()->slug('-') }}">
    <button
        class="focus:outline-none outline-none text-sm transition duration-150 ease-in-out hover:font-bold transform hover:translate-x-1"
        onclick="openSidebarItem('{{ Str::of($name)->lower()->slug('-') }}')"
    >
        <span class="{{ Str::of($name)->lower()->slug('-') }}">&#43;</span>
        <span class="{{ Str::of($name)->lower()->slug('-') }} hidden">&#8722;</span>
        {{ $name }}
    </button>
    <ul class="{{ Str::of($name)->lower()->slug('-') }} mb-2 hidden transition-all duration-150 ease-in-out">
        <li>
            <div
                class="text-sm pl-6 focus:outline-none outline-none
                            {{ auth()->check() ? 'transition duration-150 ease-in-out hover:font-bold transform
                                hover:translate-x-1' :
                                'text-gray-500'
                            }}
                    ">

                <a href="/users/create?actionOn={{ Str::of($name)->lower()->slug('-')}}">
                    Create
                </a>
            </div>
        </li>
        <li>
            <div
                class="text-sm pl-6 focus:outline-none outline-none
                            {{ auth()->check() ? 'transition duration-150 ease-in-out hover:font-bold transform
                                hover:translate-x-1' :
                                'text-gray-500'
                            }}
                    ">
                <a href="/users?actionOn={{ Str::of($name)->lower()->slug('-')}}">
                    Read
                </a>
            </div>
        </li>
        <li>
            <div
                class="text-sm pl-6 focus:outline-none outline-none
                            {{ auth()->check() ? 'transition duration-150 ease-in-out hover:font-bold transform
                                hover:translate-x-1' :
                                'text-gray-500'
                            }}
                    ">
                <a href="/users/{{
                                App\Role::whereName(Str::of($name)->lower()->slug('-'))->first()->users->first()->id
                                }}/edit?actionOn={{ Str::of($name)->lower()->slug('-')}}">
                    Update
                </a>
            </div>
        </li>
        <li>
            <div
                class="text-sm pl-6 focus:outline-none outline-none
                            {{ auth()->check() ? 'transition duration-150 ease-in-out hover:font-bold transform
                                hover:translate-x-1' :
                                'text-gray-500'
                            }}
                    ">
                <a href="/users/delete?actionOn={{ Str::of($name)->lower()->slug('-')}}">
                    Delete
                </a>
            </div>
        </li>
    </ul>
</li>
