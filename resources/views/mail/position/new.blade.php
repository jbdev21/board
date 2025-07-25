<x-mail::message>
Hi {{ $notifiable->name }}!,

A new position had been post it needs your approval. Please see details below: <br>

Title:
{{ $position->title }}
<br>
{!! $position->description !!}
<br>

*If you are sure to this is valid and all requirements are meet, please consider:*
[Publish Position]({{ $publishUrl }}) 
<br> 

*If you incounter a problem in this post please*
[Set as Spam]({{ $spamUrl }})   <br>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
