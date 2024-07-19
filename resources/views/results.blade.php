<!-- resources/views/results.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Student Results</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid green;
        }
        th, td {
            padding: 10px;
            text-align: justify;
        }
    </style>
</head>
<body>
    <h1>Student Results</h1>
    <p><strong>Student ID:</strong> {{ $student->id }}</p>
    <p><strong>Student Name:</strong> {{ $student->name }}</p>
    <table>
        <thead>
            <tr>
                <th>Subject Code</th>
                <th>Total Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject['subject_code'] }}</td>
                    <td>{{ $subject['total_score'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>CGPA:</strong> {{ $cgpa }}</p>
</body>
</html>