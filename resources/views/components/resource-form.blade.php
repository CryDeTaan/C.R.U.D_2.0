<div>
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
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
                        id="name"
                        type="text"
                        name="name"
                        placeholder="Name"
                        value="{{ $resource->name ?? 'Name' }}">
                </div>
            </div>
            <div class="flex items-center">
                <div>
                    <label class="block text-sm mx-2" for="field">
                        Some Field
                    </label>
                </div>
                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-700"
                        id="field" type="text"
                        name="field"
                        value="{{ $resource->field ?? 'Some text' }}">
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
