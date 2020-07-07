@extends('main')

@section('body')
    <div>
        <div class="text-2xl mb-8 mt-4">C.R.U.D me like I am high</div>
        <p>
            The idea here is to show how a C.R.U.D (Create, Read, Update, Delete) Laravel app works.
        </p>
        <p>
            These verbs basically represent the actions taken on the data. But a C.R.U.D application, so to speak, also
            needs additional areas to function. But this can actually make developing a simple C.R.U.D application very
            complicated for a new comer starting out their web developer journey.
        </p>
        <p>
            I am going to try and keep it as simple as possible, while trying to hit all the important areas, including
            Role Based Access Control.
        </p>
        <p>
            In this example I try to use generic terms like <strong>Platform</strong> and <strong>Entity</strong>. <br>
            However these can be replaced with something like <strong>&lt;Insert Blogging Platform Name
                here&gt;</strong> and <strong>&lt;Insert Publication Name here&gt;</strong>.
        </p>
        <p>
            Publications can have Admins, who manages Editors who in turn manages contributors of resources, which in
            this example could be Articles or Blogs.
        </p>
        <p>
            Try to think <a target="_blank" class="text-blue-500" href="https://medium.com/">Medium.com</a> here. ;p
        </p>
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 font-weight-light text-gray-700">#</span> Overview and
            Structure
        </div>
        <p>
            Alright, so to try and work with the idea of a blogging or publication platform like Medium but using
            general terms will require a quick definition of the different resource types which I am going to use, but
            first a note:
        </p>
        <div class="text-l my-4">Resource</div>
        <p>
            The word Resource can be widely used for which an action is performed on, a user of a web application could
            essentially be considered a resource. But it is important to note that resource in the example / explanatory
            application, a resource is referred to or defined as a the final 'product' of platform. And in the case of a
            blogging or publication platform like Medium that will generally be the article or blog post.
            So with that, the first definition is that a resource in this case should be seen as a Article or blog post.
            Here is a somewhat random
            <a target="_blank" class="text-blue-500"
               href="https://medium.com/@TheWineDream/wine-101-the-art-of-blending-wine-9c473cd24e62">resource /
                article</a>
            I chose from Medium.com.
        </p>
        <div class="text-l my-4">Platform Admins and Platform Contributors</div>
        <p>
            For the remaining definitions, I think we can start at the top, top being the Platform. And this is simple,
            the platform is Medium.com. What does a Platform need though? Well, for this example at least, I want it to
            have Platform Admins and Platform Contributors as far as Users are considered, but it also needs Entities.
            But before I get to Entities, let me list these mentioned Users.
        </p>
        <p>
            Platform Admins and Platform Contributors are essentially the same, apart from the permissions they may
            have. Platform Admins can additionally Create and Delete Entities which the Platform Contributors cannot.
            But for the rest, both have the ability to Read and Update Entities, and Create, Read, Update, and Delete
            Entity Admins(which I will get to).
        </p>
        <div class="text-l my-4">Entities</div>
        <p>
            Entities could be related to a publication on Medium.com for example.
            A <a target="_blank" class="text-blue-500" href="https://medium.com/the-wine-dream">Entity / Publication</a>
            on Medium.com would act independently from the platform in the articles they publish, the Entity /
            Publication may also want resource / article Owners and Contributors which should generally be created by an
            Entity Admin as there should be no reason for a Platform Admin, in this example and Admin of Medium.com, to
            create resource / article Owners and Contributors. So this is where an Entity Admin comes into play.
        </p>
        <div class="text-l my-4">Entity Admins</div>
        <p>
            The Entity Admins role will have ability to add Resource Owners and Resource Contributors for the Entity
            they manage. Just a reminder, a resource in this example app is nothing more than an article or blog post.
        </p>
        <div class="text-l my-4">Resource Owners</div>
        <p>
            Resource Owner as the name suggests owns the resource, i.e. article or blog post. They have the ability to
            Create, Read, Update, and Delete a resource. They also have the ability to assign Resource Contributors to
            the Resources they own.
        </p>
        <div class="text-l my-4">Resource Contributors</div>
        <p>
            Resource Contributors can only contribute to resources they have been assigned to through the Read and
            Update abilities.
        </p>
        <div class="text-l my-4">To sum up</div>
        <ol class="list-decimal mb-4 text-xs pl-10">
            <li>
                Platform: Platform Admins, Platform Contributors, and Entities.
            </li>
            <li>
                Entity: Entity Admins, Resources, Resource Owners, and Resource Contributors.
            </li>
        </ol>
        <p>

            The roles are implemented in such a way that just because a user is a Platform Admin it doesn't allow them
            to contribute to the Resources as well, like a Resource Contributor. No, a Platform Admin, administers the
            platform. I hope that makes sense.
        </p>
        <div class="text-l my-4">Looking at it as a story</div>
        <p>
            So, let me try create a scenario. I create a publication platform where companies can subscribe to.
            The companies are considered the Entities on this publications platform. Once a company subscribes,
            a Platform Admin will create an Entity resource representing the company and an Entity Admin, who will
            managed the resources to this Entity. And sure, it's not really necessary to have a Platform Admin add an
            entity, but I am trying to explain multi tenant permissions.
        </p>
        <p>
            Once the Entity and Entity Admin are created, the Entity Admin can go on and create Resource Owners and
            Contributors. Resources Owners in this scenario could be considered a Managing Editor for the publication.
            The Resource Owner can then create a Resource, which essentially represents an article of sorts. The
            Resource Owner can not only publish these mentioned articles, but also assign Resource Contributors, for
            example an editor at the company making use of the platform. The editor may only be allowed to make changes
            or additions to the articles, but need to be reviewed and published by the Resource Owner.
        </p>
        <p>
            The application must be built with the necessary permissions in mind. Meaning that Entity users should
            not be accessible from other Entity Resources, i.e. Entity Admins, Resource Owners or Contributors.
            In addition, Platform Admins and Contributors should not be able to actually access the Entity's Resources.
        </p>
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 font-weight-light text-gray-700">#</span> Impersonating and
            How to use
        </div>
        <p>
            With the definition and scenario out of the way, let me quickly explain how to use this app. It is possible
            to impersonate an user and then perform then actions on the different resources.
        </p>
        <p>
            Impersonate an user by selecting an 'Impersonations' option from the sidebar to the left. This will simulate
            an authentication attempt and the authenticated user's information will returned and displayed. Below is an
            example of how an authenticated user's object is returned, which can be accessed in the view.
        </p>
        <p>
            Once a User has been impersonated, it is possible to perform the action the selected user's role has
            permission to perform. The action essentially dictates the which C.R.U.D. action to perform on a given
            resource. For example, Impersonating the Platform Admin will allow the ability to add an Entity but will not
            be allowed to add a Resource Contributor.
        </p>
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-home.user/></code></pre>
        </div>
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 font-weight-light text-gray-700">#</span> Model View
            Control ++
        </div>
        <p>
            In the following section I will try to explain the Model View Control Architecture and specifically how it
            is translated into Laravel. I will also discuss some other areas needed to make this example application
            function like Role-Based Access control, Policies and more.
        </p>
        <div class="text-l my-4">Note</div>
        <p>
            Keep in mind that the way I am using these Laravel directives is not necessarily the only or best option,
            its merely one of the options. For example, specifying a route can be done as a closure, or you can make
            use of Route Groups. So please assume that everything I am showing isn't necessarily the best or
            only way of doing something :)
        </p>

        <div class="text-xl mb-4 mt-12"><span class="-ml-6 text-gray-700">#</span> Route</div>
        <p>
            As far a developer using the Laravel framework is concerned it all start here at the
            <code class="myCode">routes/web.php</code> file. There is also <code class="myCode">routes/api.php</code>
            and some other, but lets not worry about that for now. Obviously the Laravel frameworks takes care of a few
            things for you when you visit a Laravel based Wep App but for now, just know that the route will start
            executing the logic of the application and is defined in <code class="myCode">routes/web.php</code>. This is
            the entry point to the application.

        </p>
        <p>
            Lets use an example where by the Entity > Read action is selected on the Sidebar. This will instruct the
            browser to navigate to <code class="myCode">http://crud_2.0.test/entities</code>, the request will
            initiated a particular part of the application logic as the Route, <code class="myCode">entities</code>, is
            requested. The route is registered in the <code class="myCode">routes/web.php</code> file. Further, as this
            request is a standard <code class="myCode">GET</code> request, the Route is also defined with the expected
            HTTP method. Finally, te second argument specifies the controller and the function to call. In this case the
            <code class="myCode">index</code> method within the <code class="myCode">EntityController</code> controller.
        </p>
        <div class="p-1 border rounded-md mb-2">
            <pre><code class="text-xs bg-gray-200 php"><x-home.route/></code></pre>
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
        {{-- RBAC Description --}}
        <div class="text-xl mb-4 mt-12"><span class="-ml-6 font-weight-light text-gray-700">#</span> Role Based Access
            Control
            <p>
                Role based access control is achieved through Policies. Fortunately, Laravel has 'resourceful' policies
                for
                actions on models when resourceful controllers are used.
            </p>
            <p>
                To 'enable' this, the authorizeResource method in the should be added to the resourceful controller's
                constructor; <code class="myCode">$this->authorizeResource(User::class, 'user');</code>. The
                <code class="myCode">authorizeResource</code> method accepts the model's class name as its first
                argument,
                and the name of the route / request parameter that will contain the model's ID as its second argument.
            </p>
            <p>
                To have the required method signatures and type hints both the controller and the policy should be
                created
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
                At this point it should be noted that the User Model has a <code
                    class="myCode">$user->abilities()</code>
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
        </div>
    </div>
@endsection
