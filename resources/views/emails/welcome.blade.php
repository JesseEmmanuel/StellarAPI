<x-mail::message>
# Welcome to Stellar

Hi {{ $firstname }}! Welcome to Stellar! Your Account has been successfully created by {{ $createdBy }}.
Below are your username and password to get started. </br>

<p> <em>*Note: You may change your credential inside the app</em> </p>

Username: {{ $userName }} <br>
Password: {{ $password }}

Click the button down below to get started

<x-mail::button :url="''">
Go To Stellar
</x-mail::button>

Thanks,<br>
We are Stellar
</x-mail::message>
