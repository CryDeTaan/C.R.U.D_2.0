@extends('main')

@section('body')
    <div>
        <div class="text-2xl mb-8 mt-4">C.R.U.D me like I am high</div>

        {{-- Intro --}}
        <p>
            The idea here is to show how a C.R.U.D (Create, Read, Update, Delete) Laravel app works.
        </p>
        <p>
            These verbs represent the actions taken on the data, but a C.R.U.D application, so to speak, also needs
            additional areas to be functional. This can actually make developing a simple C.R.U.D application very
            complicated for a newcomer starting out their web development journey.
        </p>
        <p>
            I am going to try and keep it as simple as possible, while trying to hit all the important areas, including
            Role Based Access Control.
        </p>
        <p>
            For the sake of simplicity, I try to use generic terms such as <strong>Platform</strong> and
            <strong>Entity</strong>. <br>
            However, these can be replaced with something along the lines of <strong>&lt;Insert Blogging Platform Name
                here&gt;</strong> and <strong>&lt;Insert Publication Name here&gt;</strong>.
        </p>
        <p>
            Publications can have Admins, who manage Editors who in turn manage contributors of resources, which in
            this example could be Articles or Blog Posts.
        </p>
        <p>
            Try to think <a target="_blank" class="text-blue-500" href="https://medium.com/">Medium.com</a> here. ;p
        </p>

        {{-- Overview and Structure --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 font-weight-light text-gray-700">#</span> Overview and
            Structure
        </div>
        <p>
            Alright, so to try and work with the idea of a blogging or publication platform like Medium but using
            general terms will require a quick list of definitions of the different resource types which I am going to
            use.
        </p>

        {{-- Resource Overview --}}
        <div class="text-l my-4">Resource</div>
        <p>
            The word Resource can be used to describe a collection of data on which an action is performed; a user of a
            web application can essentially be considered a resource. But it is important to note that resource in this
            example / explanatory application can be defined as the final 'product' of platform. In the case of a
            blogging or publication platform, like Medium, the resource will generally be the article or blog post. So
            with that in mind, the first definition follows: A resource, in this case, should be seen as an article or
            blog post. Here is a somewhat random
            <a target="_blank" class="text-blue-500"
               href="https://medium.com/@TheWineDream/wine-101-the-art-of-blending-wine-9c473cd24e62">resource /
                article</a>
            I chose from Medium.com.
        </p>

        {{-- >Platform Admins and Contributors Overview --}}
        <div class="text-l my-4">Platform Admins and Platform Contributors</div>
        <p>
            Platform: this is simple, the platform is the application or website where resources live and actions are
            performed by users with different roles; it is essentially Medium.com. What does a Platform need though?
            Well, for this example at least, I want it to have Platform Admins and Platform Contributors as far as Users
            are concerned, but it also needs Entities. Before I get to Entities, let me defined the aforementioned User
            roles.
        </p>
        <p>
            <strong>Platform Admins</strong> and <strong>Platform Contributors</strong> are essentially the same, apart
            from the permissions assigned to each. Both have the ability to Read and Update Entities, and Create, Read,
            Update, and Delete Entity Admins (definition to follow below). In addition to these actions, Platform Admins
            can also Create and Delete Entities which the Platform Contributors cannot.
        </p>

        {{-- Entities Overview --}}
        <div class="text-l my-4">Entities</div>
        <p>
            Entities can be defined as a publication, similar to publications on Medium.com for example.
            An <a target="_blank" class="text-blue-500" href="https://medium.com/the-wine-dream">Entity /
                Publication</a>
            on Medium.com would act independently from the platform in the articles that they publish, the Entity /
            Publication may also want resource / article Owners and Contributors which should generally be created by an
            Entity Admin as there should be no reason for a Platform Admin, in this example and in the case of
            Medium.com, to create resource / article Owners and Contributors. So this is where an Entity Admin comes
            into play.
        </p>

        {{-- Entity Admins Overview --}}
        <div class="text-l my-4">Entity Admins</div>
        <p>
            The Entity Admin's role will have the ability to add Resource Owners and Resource Contributors for the
            Entity that they manage. Just a reminder, a resource in this example app is nothing more than an article or
            blog post.
        </p>

        {{-- Resource Owner Overview --}}
        <div class="text-l my-4">Resource Owners</div>
        <p>
            A Resource Owner as the name suggests owns the resource, i.e. article or blog post. They have the ability to
            Create, Read, Update, and Delete a resource. They also have the ability to assign Resource Contributors to
            the Resources they own.
        </p>

        {{-- Resource Contributor Overview --}}
        <div class="text-l my-4">Resource Contributors</div>
        <p>
            Resource Contributors can only contribute to resources they have been assigned to. For these resource they
            have Read and Update abilities.
        </p>

        {{-- Overview Summary --}}
        <div class="text-l my-4">Overview Summary</div>
        <ol class="list-decimal mb-4 text-xs pl-10">
            <li>
                Platform: Platform Admins, Platform Contributors, and Entities.
            </li>
            <li>
                Entity: Entity Admins, Resources, Resource Owners, and Resource Contributors.
            </li>
        </ol>
        <p>
            The roles are implemented in such a way that if a user is assigned the Platform Admin role this doesn't
            allow them to contribute to a Resources as well; they don't have Resource Contributor role permissions. A
            Platform Admin can only administer the platform.
        </p>


        {{-- Setting the scene --}}
        <div class="text-l my-4">Setting the Scene using a story</div>
        <p>
            So, let me try and create a scenario. I create a publication platform to where companies can subscribe to.
            The companies that are subscribed are considered the Entities on this platform. Once a company subscribes,
            a Platform Admin will create an Entity resource representing the company and an Entity Admin, who will
            managed the resources for this Entity. And sure, it's not really necessary to have a Platform Admin add an
            entity, but I am trying to explain multi-tenant permissions.
        </p>
        <p>
            Once the Entity and Entity Admin are created, the Entity Admin can go on and create Resource Owners and
            Contributors. Resource Owners in this scenario could be considered a Managing Editor for the publication.
            The Resource Owner can then create a Resource, which essentially represents an article of sorts. The
            Resource Owner can not only publish these articles, but also assign Resource Contributors, for example an
            editor at the company making use of the platform. The editor may only be allowed to make changes
            or additions to the articles which need to be reviewed and published by the Resource Owner.
        </p>
        <p>
            The application must be built with the necessary permissions in mind. Meaning that Entity users should
            not be accessible from other Entity Resources, i.e. Entity Admins, Resource Owners or Contributors.
            In addition, Platform Admins and Contributors should not be able to actually access the Entity's Resources.
        </p>


        {{-- Impersonating and How to use --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 font-weight-light text-gray-700">#</span> Impersonating and
            How to use
        </div>
        <p>
            With the definitions and scenario out of the way, let me quickly explain how to use this app. It is possible
            to impersonate a user and then perform their actions on the different resources.
        </p>
        <p>
            Impersonating a user is done by selecting an 'Impersonations' option from the sidebar to the left. This will
            simulate an authentication attempt and the authenticated user's information will be returned and displayed.
            Below is an example of how an authenticated user's object is returned, which can be accessed in the view.
        </p>
        <p>
            Once a User has been impersonated, it is possible to perform the action(s) the selected user's role has
            permission to perform. The action essentially dictates which C.R.U.D. action to perform on a given
            resource. For example, Impersonating the Platform Admin will allow the ability to add an Entity but will not
            allow for a Resource Contributor to be added.
        </p>

        {{-- User Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-home.user/></code></pre>
        </div>


        {{-- MVC Overview --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 font-weight-light text-gray-700">#</span> Model View
            Control ++
        </div>
        <p>
            In the following section I will try to explain the Model View Control Architecture and specifically how it
            is translated into Laravel. In the following section I will try to explain the Model View Control
            Architecture and specifically how it is translated into Laravel. I will also discuss some other areas needed
            to make this example application function; like Role-Based Access control, Policies and more.
        </p>
        <div class="text-l my-4">Note</div>
        <p>
            Keep in mind that the way I am using these Laravel directives is not necessarily the only or best option,
            its merely one of the options. For example, specifying a route can be done as a closure, or you can make
            use of Route Groups. So please assume that everything I am showing isn't necessarily the best or
            only way of doing something :) - there is always room for improvement.
        </p>


        {{-- MVC - Route --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            As far as a developer using the Laravel framework is concerned, it all starts here at the
            <code class="myCode">routes/web.php</code> file. There is also <code class="myCode">routes/api.php</code>
            and some others, but let's not worry about that for now. Obviously the Laravel framework takes care of a few
            things for you when you visit a Laravel based Wep App, but for now just know that the route will start
            executing the logic of the application and is defined in <code class="myCode">routes/web.php</code>. This is
            the entry point to the application.
        </p>
        <p>
            Let's use an example whereby the Entity > Read action is selected on the Sidebar. This will instruct the
            browser to navigate to <code class="myCode">http://crud_2.0.test/entities</code>, the request will
            initiate a particular part of the application logic as the Route, <code class="myCode">entities</code>, is
            requested. The route is registered in the <code class="myCode">routes/web.php</code> file. Further, as this
            request is a standard <code class="myCode">GET</code> request, the Route is also defined with the expected
            HTTP method. Finally, te second argument specifies the controller and the function to call. In this case the
            <code class="myCode">index</code> method within the <code class="myCode">EntityController</code> controller.
        </p>

        {{-- MVC - Route Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-home.route/></code></pre>
        </div>


        {{-- MVC - Controller --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            I generally, well not just me - most Laravel developers, use controllers to group related requests handling logic into a single
            class. The controller essentially becomes responsible for the all the C.R.U.D. actions on a specific resource.
            This pattern is followed so much in the community that Laravel provides Resource Controllers. When adding a
            Controller use the <code class="myCode">--resource</code> flag to automatically add all the C.R.U.D.
            actions as a skeleton.
        </p>
        <p>
            The table below stipulates all the Actions in the C.R.U.D design pattern with the relevant Verb, URI, as well as the
            Controller with the method.
        </p>

        {{-- Resource Controller Table --}}
        <x-home.crud-table/>
        <p>
            The C.R.U.D. action in this example, Read Index, will be handled by the
            <code class="myCode">EntityController</code> which will call the <code class="myCode">index</code> method. This
            particular example is simple, it basically gets all the Entities using Laravel's
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/eloquent#retrieving-models">Eloquent
                ORM</a>
        </p>
        <p>
            In the example Controller's <code class="myCode">constructor</code> I specify an auth middleware. This will
            require a valid authenticated user session before accessing any of the methods within the Controller.
        </p>

        {{-- MVC - Controller Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-home.controller/></code></pre>
        </div>


        {{-- MVC - Model --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            In Laravel the Eloquent ORM is a simple ActiveRecord implementation for working with the application's
            database. Each database table has a corresponding "Model" which is used to interact with that table. Models
            allow for the ability to query data in tables, as well as work with and manipulate the records in the tables.
        </p>
        <p>
            Additionally, the Eloquent ORM also provides relationships as Database tables are often related to one
            another. In my example scenario, an entity has resource owners and contributors, essentially... users of
            the entity.
        </p>
        <p>
            To make use of the Eloquent ORM relationships in this scenario I outlined above, a relationship's
            definition may look something like this.
        </p>
        <ol class="list-decimal mb-4 text-xs pl-10">
            <li>
                The App\Entity has many App\User.
            </li>
            <li>
                The App\User belongs to App\Entity
            </li>
        </ol>
        <p>
            As I have been using Entity in the examples so far, I will continue with the Entity Model, but note that
            although I mention <code class="myCode">App\User</code> above it is fairly similar, apart from the method
            containing <code class="myCode">return $this->belongsTo(Entity::class);</code>.
        </p>
        <p>
            In any case, defining the relationships on an instance of the Entity model allows the use of dynamic
            properties to access the related model as if the property is defined on the model. For example, to access
            all the users that belongs to an Entity is as simple as using <code class="myCode">$entity->users;</code>
        </p>

        {{-- MVC - Model Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-home.model/></code></pre>
        </div>


        {{-- MVC - View --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            The final part in the Model View Controller life cycle is the View. The controller and model retrieve and
            prepare the data that will be sent to the view, if any. The view is essentially the presentation layer or
            logic which is separate from that of the controller/application logic or layer.
        </p>
        <p>
            In this example I make use of the Laravel templating engine, called Blade, by specifying a global
            <code class="myCode">view</code> helper with two parameters:
            <code class="myCode">return view('actions.entity.read', compact('entities'));</code>
        </p>
        <ol class="list-decimal mb-4 text-xs pl-10">
            <li>
                The target view - in this case <code class="myCode">actions.entity.read</code>. All views are stored at
                <code class="myCode">resources/views/</code> which means this view lives at
                <code class="myCode">/resources/views/entity/read.blade.php</code>. The <code class="myCode">.blade.php</code> extension is
                important for the templating engine to function and blade templates can be accessed either by
                <code class="myCode">/</code> or <code class="myCode">.</code> notation.
            </li>
            <li>
                The data object - in this case the prepared <code class="myCode">entities</code> object in json format.
            </li>
        </ol>
        <p>
            This page you are reading now, is the actual rendered HTML from the
            <code class="myCode">/resource/views/about.blade.php</code> view 😀
        </p>
        <p>
            One of the neat features of the blade templating engine is the second point, the data object. This allows me
            to access the object in the view, and as a matter of fact, multiple objects can be sent to the view if you
            so choose.
        </p>
        <p>
            The data object below will be sent to the view for rendering that which is essentially a JSON payload, and can be
            accessed by the view. For example, <code class="myCode">&#123;&#123; $entity->name &#125;&#125;</code> will
            render the entity name in the HTML which will be returned during the response part of the request life
            cycle.
        </p>

        {{-- MVC - Controller View Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-home.view/></code></pre>
        </div>
        <p class="mt-6">
            It it is important to note that I am not limited to using the Laravel Blade templating engine, the
            Laravel Application can act as a API 'service' which means that data can be returned as a JSON payload as well.
        </p>


        {{-- RBAC Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 font-weight-light text-gray-700">#</span>
            Role Based Access Control
        </div>
        <p>
            We are now moving away from the Model View Controller architecture to discuss some other components; starting with
            Role Based Access control which is achieved through Policies. Fortunately, Laravel has 'resourceful'
            policies for actions on models when resourceful controllers are used, which is what I am using in this case.
        </p>
        <p>
            To 'enable' this, the <code class="myCode">authorizeResource</code> method should be added to the resourceful controller's
            constructor; <code class="myCode">$this->authorizeResource(Entity::class, 'Entity');</code>. The
            <code class="myCode">authorizeResource</code> method accepts the model's class name as its first
            argument, and the name of the route / request parameter that will contain the model's ID as its second
            argument.
        </p>
        <p>
            To have the required method signatures and type hints both the controller and the policy should be
            created using the <code class="myCode">--model</code> flag. <br>For more information on Authorizing
            Resource Controllers please see the <a target="_blank" class="text-blue-500"
                                              href="https://laravel.com/docs/7.x/authorization#via-controller-helpers">
                Authorizing Resource Controllers</a> section from the Laravel Authorization Documentation.
        </p>

        {{-- Controller Constructor Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.entity.constructor/></code></pre>
        </div>
        <p>
            Having the constructor defined will, for example, automatically use the viewAny method in the
            <code class="myCode">App\Policies\EntityPolicy</code> when the index method in the Entity Controller is
            called as viewAny matched the index or C.Read.U.D action.
        </p>

        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.generic
                        className="Entity"
                        message="read models"
                        method="viewAny"
                        ability="read_entity"
                    /></code></pre>
        </div>
        <p>
            At this point it should be noted that the User Model has a <code class="myCode">$user->abilities()</code>
            property which is used to make sure the user attempting the action has the required ability.
        </p>
        <p>
            There are two <code class="myCode">Many-to-Many</code> relationships at play here:
        </p>
        <ol class="list-decimal mb-4 text-xs pl-10">
            <li>
                User -> <a class="text-blue-500" href="/roles">Roles</a>: A User may be assigned many Roles
            </li>
            <li>
                Role -> <a class="text-blue-500" href="/abilities">Abilities</a>: A Role may have many Abilities.
            </li>
        </ol>
        <p>
            To get to a user's abilities, I map over each role to get the abilities.
        </p>

        {{-- Model/Role Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-models.user.roles/></code></pre>
        </div>

        {{-- Migrations --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Migrations</div>
        <p>
            I do not want to go into detail on what migrations are and how they should be used, for that I suggested
            looking at the Laravel
            <a target="_blank" class="text-blue-500" href="https://laravel.com/docs/7.x/migrations">Migrations</a>
            documentation.
        </p>
        <p>
            I do, however, want to point out a few things which are required for relationships to function which in turn
            allows me make use of Roles and Abilities or assign a User to a Resource.
        </p>

        {{-- Roles Migration --}}
        <div class="text-l my-4">Roles Migration</div>
        <p>
            Firstly the roles migration, as can be seen from the code block below, creates two tables containing Roles
            and Abilities. Then two pivots are created, the first is the <code class="myCode">ability_role</code> pivot,
            which enables the Many-to-Many relationship between Abilities and Roles. Secondly, the
            <code class="myCode">role_user</code> pivot which enables the Many-to-Many relationship between Roles and
            User is created.
        </p>

        {{-- Roles Migration Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-home.roles-migration/></code></pre>
        </div>

        {{-- Resources Migration --}}
        <div class="text-l my-4">Resources Migration</div>
        <p>
            Secondly the resource migration which also has a pivot table, <code class="myCode">resource_user</code>, but
            something else to notice is the <code class="myCode">user_id</code> and
            <code class="myCode">entity_id</code> fields on the Resource Table. These are required for the
            <code class="myCode">belongsTo()</code> and <code class="myCode">hasMany()</code> relationships between a
            Resource and a User and a Resource and an Entity. When
            <a target="_blank" class="text-blue-500" href="/resources?actionOn=resource">viewing</a> Resources. The
            Model section will give an overview of how these are used.<br>
            (Note: Be sure to impersonate the Resource Owner or Resource Contributor to view Resources)
        </p>

        {{-- Resource Migration Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-home.resources-migration/></code></pre>
        </div>

        {{-- Users Migration --}}
        <div class="text-l my-4">Users Migration</div>
        <p>
            Even though there is not much more to say here, I do want to mention that the User model also has a
            <code class="myCode">belongsTo()</code> relationship with the Entity Model <code
                class="myCode">hasMany()</code>. This is achieved by adding a foreign ID field <code class="myCode">$table->foreignId('entity_id')</code> in the same way as the previously mentioned
            migrations.
        </p>

        {{-- Conclusion --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Conclusion</div>
        <p>
            With that, more detail on each of the components (Route, Controller, Model, Policy, and View) can be seen by
            navigating through the actions in the sidebar. Remember, not all Impersonations will have access to all the actions.
        </p>

    </div>
@endsection
