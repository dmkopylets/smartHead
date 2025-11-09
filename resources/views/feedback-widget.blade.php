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
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('#feedbackForm');

        if (!form) {
            console.error("Form element with ID 'feedbackForm' not found.");
            return;
        }

        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            const resultDiv = document.getElementById('formResult');
            resultDiv.innerHTML = '';

            const formData = new FormData(form);
            const dataObject = Object.fromEntries(formData.entries());

            const csrfToken = dataObject._token;
            delete dataObject._token;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(dataObject),
                });

                const data = await response.json();

                if (response.ok) {
                    form.reset();
                    resultDiv.innerHTML = `
                    <div class="bg-green-100 text-green-700 p-3 rounded-lg mt-3">
                        Your application has been successfully submitted! (ID: ${data.data.ticket_id})
                    </div>
                    `;
                } else if (response.status === 422 && data.errors) {
                    let errors = '';
                    for (const field in data.errors) {
                        errors += `<li>${data.errors[field].join(', ')}</li>`;
                    }

                    resultDiv.innerHTML = `
                    <div class="bg-red-100 text-red-700 p-3 rounded-lg mt-3">
                        <p class="font-bold mb-1">Validation error:</p>
                        <ul class="list-disc pl-5 text-left">${errors}</ul>
                    </div>
                    `;
                } else {
                    const message = data.message || 'An unknown error occurred on the server.';
                    resultDiv.innerHTML = `
                     <div class="bg-red-100 text-red-700 p-3 rounded-lg mt-3">
                         Error: ${message} (Status: ${response.status})
                     </div>
                     `;
                }
            } catch (error) {
                console.error('Fetch error or JSON parsing failed:', error);
                resultDiv.innerHTML = `
                    <div class="bg-red-100 text-red-700 p-3 rounded-lg mt-3">
                        Critical error. Unable to connect to the server.
                    </div>
                `;
            }
        });
    });
</script>

</body>
</html>
