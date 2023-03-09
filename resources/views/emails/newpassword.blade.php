<x-mail::message>
# Verify Requested Password

Hi {{ $firstName }} Good Day! Here is your requested password</br>

<p> <em>*Note: You may change your password inside the app</em> </p>

New Password: {{ $newPassword }}


<x-mail::button :url="''">
Go To Stellar
</x-mail::button>

Thanks,<br>
We are Stellar
</x-mail::message>
