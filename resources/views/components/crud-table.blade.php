<div class="mb-6">
    <!-- Well begun is half done. - Aristotle -->
    <table class="table w-full text-sm">
        <thead>
        <tr>
            <th class="px-4 py-2">Verb</th>
            <th class="px-4 py-2">URI</th>
            <th class="px-4 py-2">Action</th>
            <th class="px-4 py-2">Route</th>
        </tr>
        </thead>
        <tbody>
        <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700">
            <td class="border px-4 py-2">GET</td>
            <td class="border px-4 py-2">/entities</td>
            <td class="border px-4 py-2">index</td>
            <td class="border px-4 py-2">EntityController@index</td>
        </tr>
        <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700">
            <td class="border px-4 py-2">GET</td>
            <td class="border px-4 py-2">/entities/create</td>
            <td class="border px-4 py-2">create</td>
            <td class="border px-4 py-2">EntityController@create</td>
        </tr>
        <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700">
            <td class="border px-4 py-2">POST</td>
            <td class="border px-4 py-2">/entities</td>
            <td class="border px-4 py-2">store</td>
            <td class="border px-4 py-2">EntityController@store</td>
        </tr>
        <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700">
            <td class="border px-4 py-2">GET</td>
            <td class="border px-4 py-2">/entities/{entity}</td>
            <td class="border px-4 py-2">show</td>
            <td class="border px-4 py-2">EntityController@show</td>
        </tr>
        <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700">
            <td class="border px-4 py-2">GET</td>
            <td class="border px-4 py-2">/entities/{entity}/edit</td>
            <td class="border px-4 py-2">edit</td>
            <td class="border px-4 py-2">EntityController@edit</td>
        </tr>
        <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700">
            <td class="border px-4 py-2">PUT/PATCH</td>
            <td class="border px-4 py-2">/entities/{entity}</td>
            <td class="border px-4 py-2">update</td>
            <td class="border px-4 py-2">EntityController@update</td>
        </tr>
        <tr class="cursor-pointer hover:bg-gray-200 hover:border-gray-700">
            <td class="border px-4 py-2">DELETE</td>
            <td class="border px-4 py-2">/entities/{entity}</td>
            <td class="border px-4 py-2">destroy</td>
            <td class="border px-4 py-2">EntityController@destroy</td>
        </tr>
        </tbody>
    </table>
</div>
