<p>
    Because all the different user type actions are performed using the same User Controller and Model, I had
    to make sure that the action performed on the user type is allowed based on the authenticated user's role.
</p>
<p>
    To achieve this, a Role Policy was created and defined as outlined below. Take note of the requested role,
    <code class="myCode">{{ request()->actionOn }}</code>, and which
    <code class="myCode">$user->roles->contains('name','{role}')</code> rule will return true. A user's role
    property(<code class="myCode">$user->roles</code>) should contain the role required to perform the action.
</p>

{{-- Role Code Block --}}
<div class="p-1 border rounded-md mb-2">
    <pre><code class="text-xs bg-gray-200 php"><x-policies.user.role/></code></pre>
</div>
