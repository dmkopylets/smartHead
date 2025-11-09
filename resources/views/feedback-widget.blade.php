<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Feedback form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-2xl shadow-md p-6">
    <h2 class="text-2xl font-semibold text-center mb-6">Feedback</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg">
            <strong>Error!</strong>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="feedbackForm" method="POST" action="{{ url('/api/tickets') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" id="name" name="name" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone number</label>
            <input type="tel" id="phone" name="phone" placeholder="+380..." required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <input type="text" id="subject" name="subject" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
            <textarea id="message" name="message" rows="4" required
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
            Send
        </button>

        <div id="formResult" class="mt-3 text-center"></div>
    </form>
</div>

<script>
    document.querySelector('#feedbackForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const form = e.target;
        const resultDiv = document.getElementById('formResult');

        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
        });

        const data = await response.json();

        if (response.ok) {
            form.reset();
            resultDiv.innerHTML = `
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mt-3">
                Your ticket has been successfully submitted!
            </div>
        `;
        } else {
            let errors = '';
            if (data.errors) {
                for (const field in data.errors) {
                    errors += `<li>${data.errors[field].join(', ')}</li>`;
                }
            } else {
                errors = `<li>${data.message || 'An error has occurred'}</li>`;
            }

            resultDiv.innerHTML = `
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mt-3">
                <ul class="list-disc pl-5 text-left">${errors}</ul>
            </div>
        `;
        }
    });
</script>

</body>
</html>
