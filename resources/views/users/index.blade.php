<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Admin Tool</title>
</head>
<body>
    @if (session('success'))
        <div class="message show">{{ session('success') }}</div>
    @endif
    <div class="container">
        <h2>User Data from Database</h2>
        <table>
            <tr>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>Email</th>
            </tr>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="no-data">No data available.</td>
                </tr>
            @endforelse
        </table>
        <form action="{{ route('admin.import_excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="excel_file">Import Excel File:</label>
            <input type="file" name="excel_file">
            <br>
            <br>

            <label for="full_name_column">Excel Column for Full Name:</label>
            <input type="text" name="full_name_column" required>
            <br>
            <br>
            <label for="phone_number_column">Excel Column for Phone Number:</label>
            <input type="text" name="phone_number_column" required>
            <br>
            <br>
            <label for="email_column">Excel Column for Email:</label>
            <input type="text" name="email_column" required>
            <br>
            <br>
            <br>
            <button type="submit">Import Excel</button>
        </form>
    </div>



    <script>
        const messageDiv = document.querySelector('.message');
        if (messageDiv) {
            messageDiv.classList.add('show');
            setTimeout(() => {
                messageDiv.classList.remove('show');
            }, 5000);
        }
    </script>
</body>
</html>
