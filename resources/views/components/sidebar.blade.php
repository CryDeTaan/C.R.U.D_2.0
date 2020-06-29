<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    <div class="text-2xl mt-4"><a href="/">{{ config('app.name', 'Laravel') }}</a></div>

    @auth()
        <div class="text-lg font-semibold mt-6 mb-3">Impersonated:</div>
        <div class="mb-2">{{ auth()->user()->name }}</div>
        <div class="mb-2 p-1 w-48 bg-white border border-white rounded-md">
            <pre><code class="h-40 json text-xs">@json(auth()->user(), JSON_PRETTY_PRINT)</code></pre>
        </div>
    @endauth

    <div class="text-lg font-extrabold mt-8 mb-4">Platform</div>

    <div class="font-semibold mb-2">Impersonations:</div>
    <ul>
        <x-impersonate name="Platform Admin" id="1"/>
        <x-impersonate name="Platform Contributor" id="2"/>
    </ul>

    <div class="font-semibold mb-2 mt-4">Actions on:</div>
    <ul>
        <x-sidebar-actions.on-user name="Platform Contributor"/>
        <x-sidebar-actions.on-resource name="Entity"/>
        <x-sidebar-actions.on-user name="Entity Admin"/>
    </ul>

    <hr class="mx-4 my-8">

    <div class="text-lg font-extrabold mb-2">Entity</div>
    <div class="font-semibold mb-2">Impersonations:</div>
    <ul>
        <x-impersonate name="Entity Admin" id="3"/>
        <x-impersonate name="Resource Owner" id="4"/>
        <x-impersonate name="Resource Contributor" id="5"/>
    </ul>

    <div class="font-semibold mb-2 mt-4">Actions on:</div>
    <ul>
        <x-sidebar-actions.on-user name="Resource Owner"/>
        <x-sidebar-actions.on-user name="Resource Contributor"/>
        <x-sidebar-actions.on-resource name="Resource"/>
    </ul>

</div>
<script>
    function openSidebarItem(sidebarItem) {

        /*
            This is to remove any tags that are visible;
            At the end of this openSidebarItem() function, a class(selected) is added.
            This is to keep track of the item's visibility should be toggled.
            So here we find them, then toggle hidden, and remove the selected class.
            This basically resets everything apart from the Selected List Item, we'll
            take care of that in the **** REST PART TWO **** section below.
         */
        document.querySelectorAll(".selected").forEach(el => {
            el.classList.toggle('hidden');
            el.classList.remove('selected')
        });

        /*
            Here we'le find the clicked item and assign it to a variable.
         */
        const selectedListItem = document.getElementById(sidebarItem)

        /*
            If the selected item was the previously expanded item, there is no need
            for the rest of this openSidebarItem() function's execution to continue.
            All we'll want to do is complete the "reset" as mentioned earlier.
         */
        if(selectedListItem.classList.contains('selectedItem')) {
            selectedListItem.classList.remove('selectedItem');
            return;
        }

       /*
            If the selected item is not the previously selected item and the execution
            was not ended by the previous if(), we'll need to find the previously selected
            item, in order to remove the maker class
        */
        const previouslySelectedListItem = document.querySelector(".selectedItem");
        if(previouslySelectedListItem) {
            previouslySelectedListItem.classList.remove('selectedItem')
        }

        /*
            As can be seen by the code before, we need to track the selected item so that
            we can end the execution of the function. So this is where we name the List Item.
         */
        selectedListItem.classList.add('selectedItem');

        /*
            This is the simple part really, we'll find the elements we want to toggle, all the
            elements to toggle has the item name as a class name, so that we can track what should
            and should not be tracked.

            So once found, we'll toggle the hidden class and then add the 'selected' class so that we
            can find all elements and 'reset' the original visibility.
         */
        const targetElements = selectedListItem.getElementsByClassName(sidebarItem);

        for (let i = 0; i < targetElements.length; i++) {
            targetElements[i].classList.toggle('hidden');
            targetElements[i].classList.add('selected');
        }

    }
</script>
