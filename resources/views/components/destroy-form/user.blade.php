&lt;form method="POST" action="/users/{id}?actionOn={{ request()->actionOn }}">
    &#64;csrf
    &#64;method('DELETE')
    &lt;button type="submit">delete&lt;/button>
 &lt;/form>
