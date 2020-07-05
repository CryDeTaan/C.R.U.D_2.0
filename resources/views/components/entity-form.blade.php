<div class="flex justify-center mx-auto">
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
    <form class="w-full max-w-lg" action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        <div class="flex flex-wrap -mx-3 mb-4">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                    Entity Name
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3
                    px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="name" name="name" type="text"
                    value="{{ $entity->name ?? Str::of(Faker\Factory::create()->words(2, true))->title() }}">
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="field">
                    Some other field
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3
                    px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="field" name="field" type="text"
                    value="{{ $entity->field ?? Str::of(Faker\Factory::create()->word)->title() }}">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
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
