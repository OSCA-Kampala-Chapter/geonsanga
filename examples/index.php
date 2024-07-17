<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">District</h1>
        <div id="dropdown-container">
            <label for="dropdown" class="block text-gray-700">Select a district:</label>
            <select id="dropdown" class="block w-full mt-2 p-2 border border-gray-300 rounded-md">
                <option value="">Loading...</option>
            </select>
        </div>
    </div>
    <script>
        async function fetchOptions() {
            try {
                const response = await fetch('http://localhost:8080/v1/districts');
                const data = await response.json();
                console.log(data.districts);
                const dropdown = document.getElementById('dropdown');
                dropdown.innerHTML = data.districts.map(option => `<option value="${option}">${option}</option>`).join('');
            } catch (error) {
                console.error('Error fetching options:', error);
            }
        }
        document.addEventListener('DOMContentLoaded', fetchOptions);
    </script>
</body>
</html>
