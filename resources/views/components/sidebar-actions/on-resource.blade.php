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
                <a href="/{{ Str::of($name)->lower()->plural() }}/create?actionOn={{ Str::of($name)->lower() }}">
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
                <a href="/{{ Str::of($name)->lower()->plural() }}?actionOn={{ Str::of($name)->lower() }}">
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
                @if(auth()->check())
                <a href="/{{ Str::of($name)->lower()->plural() }}/{{ App\Resource::where('user_id', auth()->user()->id)->first()->id ?? 1 }}/edit?actionOn={{ Str::of($name)->lower() }}">
                    Update
                </a>
                @else
                    <a href="/{{ Str::of($name)->lower()->plural() }}/1/edit?actionOn={{ Str::of($name)->lower() }}">
                        Update
                    </a>
                @endif
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
                <a href="/{{ Str::of($name)->lower()->plural() }}/delete?actionOn={{ Str::of($name)->lower() }}">
                    Delete
                </a>
            </div>
        </li>
    </ul>
</li>
