<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Fuel Request Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
  <div class="bg-white p-8 rounded-md shadow-md w-full max-w-lg">
    <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Fuel Request Form</h2>

    <form class="space-y-6">
      <!-- Vehicle Number -->
      <div>
        <label for="vehicleNumber" class="block text-gray-700 font-medium mb-1">Vehicle Number</label>
        <input
          type="text"
          id="vehicleNumber"
          name="vehicleNumber"
          placeholder="ABC1234"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          required
        />
      </div>

      <!-- Fuel Type and Quantity -->
      <div class="flex space-x-4">
        <div class="flex-1">
          <label for="fuelType" class="block text-gray-700 font-medium mb-1">Fuel Type</label>
          <select
            id="fuelType"
            name="fuelType"
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          >
            <option value="" disabled selected>Select fuel type</option>
            <option>Petrol</option>
            <option>Diesel</option>
            <option>CNG</option>
          </select>
        </div>

        <div class="flex-1">
          <label for="quantity" class="block text-gray-700 font-medium mb-1">Quantity (Liters)</label>
          <input
            type="number"
            id="quantity"
            name="quantity"
            min="1"
            placeholder="e.g., 50"
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          />
        </div>
      </div>

      <!-- Date -->
      <div>
        <label for="date" class="block text-gray-700 font-medium mb-1">Date</label>
        <input
          type="datetime-local"
          id="date"
          name="date"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          required
        />
      </div>

      <!-- Description -->
      <div>
        <label for="description" class="block text-gray-700 font-medium mb-1">Description</label>
        <textarea
          id="description"
          name="description"
          rows="3"
          placeholder="Enter any additional details"
          class="w-full border border-gray-300 rounded-md px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
        ></textarea>
      </div>

      <!-- Submit Button -->
      <div>
        <button
          type="submit"
          class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors"
        >
          Submit Request
        </button>
      </div>
    </form>
  </div>
</body>
</html>

</body>
</html>
