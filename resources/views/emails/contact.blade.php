<x-mail::message>
# New Project Inquiry

You have received a new contact form submission from **{{ $data['first_name'] }} {{ $data['last_name'] }}**.

**Email:** {{ $data['email'] }}  
**Project Type:** {{ $data['project_type'] }}  
**Budget:** {{ $data['budget'] }}

### Project Details
{{ $data['details'] }}

<x-mail::button :url="config('app.url') . '/admin/messages'">
View in Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
