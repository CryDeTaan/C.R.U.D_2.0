@extends('main')

@section('body')
    <div>
        <div class="text-2xl mb-8 mt-4">C.R.U.D me like I am high</div>
        <p>
            The idea here is to show how a C.R.U.D (Create, Read, Update, Delete) Laravel app works.
        </p>
        <p>
            These verbs basically represent the actions taken on the data. But a C.R.U.D application, so to speak, also
            needs additional areas to function. But this actually adds some additional confusion, so I am not sure if I
            should mention that. Maybe I'll add some more explanation in the controller section, but in the mean time
            please have a look at Laravel's documentation on <a
                target="_blank"
                class="text-blue-500"
                href="https://laravel.com/docs/master/controllers#resource-controllers"
            >Resource Controllers</a>.
        </p>
        <p>
            In this example I try to use generic terms like <strong>Platform</strong> and <strong>Entity</strong>. <br>
            However these can be replaced with something like <strong>&lt;Insert Blogging Platform Name
                here&gt;</strong> and
            <strong>&lt;Insert Publication Name here&gt;</strong>.
        </p>
        <p>
            Publications can have Admins, who manages Editors who in turn manages contributors of resources, which in
            this example could be Articles or Blogs.
        </p>
        <p>
            Try to think <a target="_blank" class="text-blue-500" href="https://medium.com/">Medium.com</a> here. ;p
        </p>
        <p class="mb-0">
            Resources in this example includes resources for two parts of the platform:
        </p>
        <ol class="list-decimal mb-4 text-xs pl-10">
            <li>
                Platform resources; admins, contributors, and then the entities. The entities are really what the
                platform is about.
            </li>
            <li>
                Entity resources; entity admins, resources, resource owners, and resource contributors.
            </li>
        </ol>
        <p>
            So, let me try create a scenario. I create a publication platform where companies can subscribe to.
            The companies are considered the entities on this publications platform. Once a company subscribes,
            a platform admin will create an entity resource representing the company and an entity admin, who will
            managed the resources to this entity. And sure, it's not really necessary to have a platform admin add an
            entity, but I am trying to explain multi tenant permissions.
        </p>
        <p>
            Once the entity and entity admin are created, the entity admin can go on and create resource owners.
            Resources owners in this scenario could be considered a Managing Editor for the publication. The resource
            owner can then create a resource, which essentially represents an article of sorts. The resource owner can
            not only publish these mentioned articles, but also add resource contributors, for example an editor at the
            company making use of the platform. The editor may only be allowed to make changes or additions to the
            articles, but need to be reviewed and published by the resource owner.
        </p>
        <p>
            The application must be built with the necessary permissions in mind. Meaning that entity resources should
            not be accessible from other entity resources, i.e. entity admins, resource owners or contributors.
            In addition, platform admins and contributors should not be able to actually access the entity resources.
        </p>
        <div class="text-l my-4">Note</div>
        <p>
            Keep in mind that the way I am using these Laravel directives is not necessarily the only or best option,
            its merely one of the options. For example, specifying a route can be done as a closure, or you can make
            use of Route Groups. So please assume that everything I am showing isn't necessarily the best or
            only way of doing something :)
        </p>
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 font-weight-light text-gray-700">#</span> Impersonating</div>
        <p>
            Impersonate an user by selecting an 'Impersonations' option from the sidebar to the left. This will simulate
            an authentication attempt and the authenticated user's information will display below. This is also how the
            authenticated user's object is returned, and can be accessed:
        </p>
        <div class="p-1 border rounded-md">
            <pre><code class="json text-xs">@include('data.user')</code></pre>
        </div>

        {{-- RBAC Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 font-weight-light text-gray-700">#</span> Role Based Access
            Control
        </div>
        <p>
            Role based access control is achieved through Policies. Fortunately, Laravel has 'resourceful' policies for
            actions on models when resourceful controllers are used.
        </p>
        <p>
            To 'enable' this, the authorizeResource method in the should be added to the resourceful controller's
            constructor; <code class="myCode">$this->authorizeResource(User::class, 'user');</code>. The
            <code class="myCode">authorizeResource</code> method accepts the model's class name as its first argument,
            and the name of the route / request parameter that will contain the model's ID as its second argument.
        </p>
        <p>
            To have the required method signatures and type hints both the controller and the policy should be created
            using the <code class="myCode">--model</code> flag. <br>For more information on Authorizing Resource
            Controllers please see <a target="_blank" class="text-blue-500"
                                      href="https://laravel.com/docs/7.x/authorization#via-controller-helpers">
                Authorizing Resource Controllers</a> section from the Laravel Authorization Documentation.
        </p>
        {{-- Controller Constructor Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-controllers.user.constructor/></code></pre>
        </div>
        <p>
            Having the constructor defined will for example use the create method in the
            <code class="myCode">App\Policies\UserPolicy</code> automatically when the create or store method in the
            User Controller are called as they are both considered part of the Create.R.U.D action.
        </p>
        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-policies.user.generic
                        message="create models"
                        method="create"
                        action="create"
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
        {{-- Policy Code Block --}}
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-models.user.roles/></code></pre>
        </div>


        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            Once a user is impersonated, its time to select an action. The action essentially dictates the which
            C.R.U.D. action to perform on a given resource. And it all starts by accessing a route. This is the entry
            point to the platform. The selected route will start executing the logic of the application.

        </p>
        <p>
            By visiting this URL, <code class="myCode">http://crud_2.0.test/entities/1</code>, the request will
            initiated a
            particular part of the application logic as the Route is registered in the
            <code class="myCode">routes/web.php</code> file. This includes the HTTP method, which in this case is a
            <code class="myCode">GET</code> Method, as well as the expected URI is specified. Finally, the
            <code class="myCode">{entity}</code> parameter, in this case the ID of the requested Entity,
            is include in the URI.
        </p>
        <p>
            The second argument specifies the controller and the function to call. In this case the <code
                class="myCode">show</code> method within the <code class="myCode">EntityController</code> controller.
        </p>
        <div class="p-1 border rounded-md">
            <pre><code class="php text-xs">@include('data.route')</code></pre>
        </div>
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Controller</div>
        <p>
            The controller responsible for the selected C.R.U.D. action, in this case the <code class="myCode">EntityController</code>
            will call the <code class="myCode">show</code> method. You will notice that the show method expects a
            parameter, which is passed as the route <code class="myCode">{entity}</code> parameter, if you recall from
            the route section above.
        </p>
        <p>
            The way I specify the controller's parameter is something called Route Model Binding which
            provides a convenient way to automatically inject a model instances directly into the controller.
        </p>
        <p>
            Since the $entity <code class="myCode">variable</code> is type-hinted as the <code
                class="myCode">App\Entity</code> Eloquent model and the variable name matches the <code class="myCode">{entity}</code>
            URI segment, Laravel will automatically inject the model instance that has an ID matching the
            corresponding value from the request URI. The instance can then be accessed by its variable,
            <code class="myCode">$entity</code> in this case. As an example <code class="myCode">$entity->name;</code>
            will return the name of the entity.
        </p>
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php">@include('data.controller')</code></pre>
        </div>
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Model</div>
        <p>
            In Laravel the Eloquent ORM is a simple ActiveRecord implementation for working with your database. Each
            database table has a corresponding "Model" which is used to interact with that table. Models allow you to
            query for data in your tables, as well as insert new records into the table.
        </p>
        <p>
            Additionally, the Eloquent ORM also provides relationships as Database tables are often related to one
            another. In my example scenario, an entity has resources owners and contributors, essentially... users of
            the entity.
        </p>
        <p>
            In this scenario, I make use of two Eloquent ORM relationships.
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
            As I are currently working with the Entity model, I am specifying the has many relationship.
        </p>
        <p>
            This means that when we have an instance of the Entity model we can access all the users assigned to this
            entity by simply retrieving the related record using Eloquent's dynamic properties. Dynamic properties allow
            you to access relationship methods as if they were properties defined on the model: <code class="myCode">$entity->users;</code>
        </p>
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php">@include('data.model')</code></pre>
        </div>
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> View</div>
        <p>
            The final part in the life cycle of this app is the view. The controller and model retrieve and prepare the
            data that will be sent to the view, if any. The view is essentially the presentation layer or logic which is
            separate from that of the controller / application logic or layer.
        </p>
        <p>
            In this example I make use of the Laravel templating engine, called blade, by specifying global
            <code class="myCode">view</code> helper with two parameters.
            <code class="myCode">return view('/entities/show', compact($entity));</code>
        </p>
        <ol class="list-decimal mb-4 text-xs pl-10">
            <li>
                The target view; in this case <code class="myCode">/entity/show</code>. All views are stored at
                <code class="myCode">resources/views/</code> which means this view lives at
                <code class="myCode">/resources/views/entity/show.blade.php</code>. The .blade.php extension is
                important for the templating engine to function.
            </li>
            <li>
                The data object, in this case, the prepared entity object.
            </li>
        </ol>
        <p>
            This page you are reading now, is the actual rendered HTML from the
            <code class="myCode">/resource/views/about.blade.php</code> view :)
        </p>
        <p>
            One of the neat features of the blade templating engine is the second points, as with in the view I now have
            access to the object, and as a matter of fact, multiple objects can be sent to the view if you so choose to.
        </p>
        <p>
            The data object below will be sent to the view for rendering which is essentially a JSON payload and can be
            accessed by the view. For example,<code class="myCode">&#123;&#123; $entity->name &#125;&#125;</code> will
            render the entity name in the HTML which will be returned during the response part of the request life
            cycle.
        </p>
        <div class="p-1 border rounded-md">
            <pre><code class="text-xs bg-gray-200 php">@include('data.data')</code></pre>
        </div>
        <p class="mt-6">
            It it is important to note that you are not limited to using the Laravel Blade templating engine, the
            Laravel Application can act as a API 'service' which means data can be returned as a JSON payload as well.
        </p>
    </div>
@endsection
